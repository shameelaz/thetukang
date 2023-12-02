<?php

namespace Overdrive\Web\Http\Controllers\Frontend;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Workbench\Admin\Service\BaseServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\VideoServices;
use Workbench\Admin\Service\UserguideServices;
use Overdrive\Web\Service\SearchServices;

class SearchController extends BaseController
{
    public function form(Request $request)
	{

        $form = (new SearchServices())->search($request);

		return view('web::perakepay.frontend.public.carian.result',compact('form','request'));
	}





}
