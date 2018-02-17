<?php

namespace DesafioTecnicoMoip\Http\Controllers;

class WebController extends Controller {
	public function index() {
		return view('pages.index');
	}

	public function payment() {
		return view('pages.payment');
	}

	public function statusPayment() {
		return view('pages.status_payment');
	}
}
