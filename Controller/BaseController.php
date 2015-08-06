<?php

namespace Odiseo\Bundle\MessagingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class BaseController
{

	protected $tokenStorage;
	protected $router;
	protected $templating;
	
	public function __construct( $tokenStorage, $router , $templating){
		$this->tokenStorage = $tokenStorage;
		$this->router = $router;
		$this->templating = $templating;
	}

	protected function getUser(){
		$user = null;
		$token = $this->tokenStorage->getToken();
		if (null !== $token && is_object($token->getUser())) {
			$user = $token->getUser();
		}
		return $user;
	}

	protected function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }
    
    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
    	return $this->router->generate($route, $parameters, $referenceType);
    }
    
    
    public function renderView($view, array $parameters = array())
    {
    	return $this->templating->render($view, $parameters);
    }
    
    public function render($view, array $parameters = array(), Response $response = null)
    {
    	return $this->templating->renderResponse($view, $parameters, $response);
    }



}
