<?php

namespace Overdrive\Web\Http\Controllers\Backend;

use Illuminate\Routing\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return redirect()->route('epicentrum::users.index');
    }
}
