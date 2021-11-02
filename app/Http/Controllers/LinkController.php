<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;

/**
 * Class LinkController
 * @package App\Http\Controllers
 */
class LinkController extends Controller
{
    /**
     * Shows the form for making short links
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function index()
    {
        return view('form');
    }

    /**
     * Creates short link based on the users input and stores it in the database
     * @param LinkRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createShortUrl(LinkRequest $request)
    {
        //A try/catch block for catching an error if hash duplicates
        try {
            $originalUrl = $request->input('originalUrl');

            $faker = \Faker\Factory::create();
            $hash = $faker->regexify('[A-Za-z0-9]{6}');

            Link::create([
                'hash' => $hash,
                'originalUrl' => $originalUrl
            ]);

            $shortUrl = env('APP_URL') . '/' . $hash;

            return view('form', compact('shortUrl'));
        } catch(\Exception $e) {
            return view('errors.default');
        }
    }

    /**
     * Redirects to the original link
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToOriginal($hash)
    {
        $link = Link::whereHash($hash)->first();

        return redirect()->away($link->originalUrl);
    }
}
