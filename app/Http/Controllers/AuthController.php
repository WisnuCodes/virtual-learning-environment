<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AuthController extends Controller
{
    private function generateCaptchaCode(): string
    {
        $code = Str::upper(Str::random(5));
        session(['auth_captcha' => $code]);

        return $code;
    }

    private function isCaptchaValid(Request $request): bool
    {
        return Str::upper((string) $request->captcha) === (string) $request->session()->get('auth_captcha');
    }

    public function showLogin()
    {
        $this->generateCaptchaCode();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'string'],
        ]);

        if (! $this->isCaptchaValid($request)) {
            $this->generateCaptchaCode();

            return back()->withErrors([
                'captcha' => 'Kode CAPTCHA tidak sesuai.',
            ])->onlyInput('email');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $this->generateCaptchaCode();
            return redirect()->intended('/');
        }

        $this->generateCaptchaCode();

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function loginCaptchaImage(Request $request): Response
    {
        $code = (string) $request->session()->get('auth_captcha', $this->generateCaptchaCode());

        $noiseText = '';
        for ($i = 0; $i < 140; $i++) {
            $noiseText .= '<circle cx="' . random_int(0, 320) . '" cy="' . random_int(0, 90) . '" r="0.8" fill="#b7b7b7" opacity="0.5" />';
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="320" height="90" viewBox="0 0 320 90">'
            . '<rect width="320" height="90" fill="#e9e9e9" />'
            . $noiseText
            . '<text x="160" y="58" text-anchor="middle" fill="#4a4a4a" font-family="Arial, sans-serif" '
            . 'font-size="56" font-weight="700" letter-spacing="3" transform="rotate(-4 160 45)">'
            . e($code)
            . '</text>'
            . '</svg>';

        return response($svg, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function showRegister()
    {
        $this->generateCaptchaCode();
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required', 'string'],
        ]);

        if (! $this->isCaptchaValid($request)) {
            $this->generateCaptchaCode();

            return back()->withErrors([
                'captcha' => 'Kode CAPTCHA tidak sesuai.',
            ])->onlyInput(['name', 'email']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        Auth::login($user);
        $this->generateCaptchaCode();

        return redirect('/');
    }

    public function redirectToGoogle(Request $request)
    {
        return $this->googleProvider()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleProvider = $this->googleProvider();

        try {
            $googleUser = $googleProvider->user();
        } catch (InvalidStateException $e) {
            // Fallback for local/dev environments where session state can be inconsistent.
            try {
                $googleUser = $googleProvider->stateless()->user();
            } catch (Throwable $fallbackError) {
                $this->generateCaptchaCode();
                Log::error('Google login callback failed after stateless fallback', [
                    'message' => $fallbackError->getMessage(),
                ]);

                return redirect()->route('login')->withErrors([
                    'email' => 'Login Google gagal. Coba lagi.',
                ]);
            }
        } catch (Throwable $e) {
            $this->generateCaptchaCode();
            Log::error('Google login callback failed', [
                'message' => $e->getMessage(),
            ]);

            return redirect()->route('login')->withErrors([
                'email' => 'Login Google gagal. Coba lagi.',
            ]);
        }

        $user = User::query()->where('google_id', '=', $googleUser->id)
            ->orWhere('email', '=', $googleUser->email)
            ->first();

        if (! $user) {
            $user = User::create([
                'name' => $googleUser->name ?: 'User Google',
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Str::random(32),
                'role' => 'student',
            ]);
        } else {
            if (! $user->google_id) {
                $user->google_id = $googleUser->id;
                $user->save();
            }
        }

        Auth::login($user, true);
        $request->session()->regenerate();
        $this->generateCaptchaCode();

        return redirect('/');
    }

    /**
     * Build Google provider with optional SSL verification toggle for local environments.
     */
    private function googleProvider()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $provider */
        $provider = Socialite::driver('google');
        $provider->setHttpClient(new GuzzleClient([
            'verify' => (bool) config('services.google.verify_ssl', true),
        ]));

        return $provider;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
