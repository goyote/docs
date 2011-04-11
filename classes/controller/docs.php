<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Docs extends Controller_Template {
		
	/**
	 * @var  string  preferred language
	 */
	protected $lang;

	/**
	 * @var  array  configuration settings
	 */
	protected $_config;

	public function before()
	{
		parent::before();

		// Load the configuration settings
		$config = $this->_config = Kohana::config('docs')->as_array();

		// The language is part of the route
		if ($lang = $this->request->param('lang'))
		{
			// Set the language and locale
			I18n::lang($lang);
			setlocale(LC_ALL, $config['language']['supported'][$lang]['locale']);

			// Remember the preferred language
			Cookie::set('lang', $this->lang = $lang);
		}
		else
		{
			// We need a language, try the cookie or use the default
			$lang = Cookie::get('lang', $config['language']['default']);

			// Redirect with a chosen language
			$this->request->redirect($this->request->uri(array('lang' => $lang)));
		}
	}

	public function action_static()
	{
		$category = $this->request->param('category');
		$article = $this->request->param('article');
		
		try
		{
			// Load the article
			$this->template->content = new View("docs/{$this->lang}/$category/$article");
		}
		catch (Exception $e)
		{
			// Article not found
			throw new HTTP_Exception_404;
		}

		$this->template->set(array(
			'category' => ucwords(Inflector::humanize($category)),
			'article' => ucwords(Inflector::humanize($article)),
			'url' => array('category' => $category, 'article' => $article),
			'navigation' => $this->_config['navigation'],
			'resources' => Arr::path($this->_config, "resources.$category.$article"),
			'languages' => $this->_config['language']['supported'],
		));
	}

} // End Controller_Docs

