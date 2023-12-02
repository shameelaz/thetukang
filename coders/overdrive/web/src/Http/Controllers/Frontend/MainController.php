<?php

namespace Overdrive\Web\Http\Controllers\Frontend;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Workbench\Admin\Service\BaseServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\VideoServices;
use Workbench\Admin\Service\UserguideServices;

class MainController extends BaseController
{
    public function index(Request $request)
	{
        // visitor()->visit();

        $banner = (new BaseServices())->bannerView($request);
        $video = (new VideoServices())->latest($request);
        $agensi = (new AgencyServices())->agensiFront($request);


		return view('web::perakepay.frontend.index',compact('banner','video','agensi'));
	}

    public function hubungi(Request $request)
	{
        $banner = (new BaseServices())->hubungi($request);
		return view('web::perakepay.frontend.hubungi',compact('banner'));
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function panduan(Request $request)
	{
        $panduan = (new UserguideServices())->listActive($request);
		return View('web::perakepay.frontend.panduan',compact('panduan'));
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function faq(Request $request)
	{

        $agencyList = (new AgencyServices())->agensiList($request);
        $faq = (new BaseServices())->faqList($request);
		return View('web::perakepay.frontend.faq',compact('faq','agencyList','request'));
	}

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getFaq(Request $request)
    {
        $faq = (new BaseServices())->faqGet($request);
        return view('web::perakepay.frontend.ajaxfaq',compact('faq','request'));

    }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	// public function feedback(Request $request)
	// {

	// 	return View('web::perakepay.frontend.feedback');
	// }

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function petalaman(Request $request)
	{
		return View('web::perakepay.frontend.petalaman');
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function desclaimer(Request $request)
	{
		return View('web::perakepay.frontend.desclaimer');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function privacy(Request $request)
	{
		return View('web::perakepay.frontend.privacy');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	public function security(Request $request)
	{
		return View('web::perakepay.frontend.security');
	}

}
