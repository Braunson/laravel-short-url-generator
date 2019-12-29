<?php

namespace App\Http\Controllers;

use App\URL;
use Illuminate\Http\Request;
use App\Services\URLServiceInterface;
use App\Http\Resources\URL as URLResource;
use App\Http\Requests\CreateURLFormRequest;

class URLController extends Controller
{
    protected $url;

    /**
     * URLController constructor.
     *
     * @param URLServiceInterface $url
     */
    public function __construct(URLServiceInterface $url)
    {
        $this->url = $url;
    }

    /**
     * Display the form
     *
     * @return mixed
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Save the url in the database and return the hashed result
     *
     * @param CreateURLFormRequest $request
     * @return Response
     */
    public function store(CreateURLFormRequest $request)
    {
        $url = $this->url->create($request->validated());

        return response()->json(
            new URLResource($url)
        );
    }

    /**
     * Visit the decoded URL for the hahs given
     *
     * @param  URL $url
     * @return Redirect
     */
    public function visit(URL $url)
    {
        $this->url->recordVisit($url);

        return redirect()->to($url->url);
    }
}
