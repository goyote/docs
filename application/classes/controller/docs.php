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
			$view = new View("docs/{$this->lang}/$category/$article");
		}
		catch (Exception $e)
		{
			// Oh noes!
			$this->response->status(404);
			$view = new View('404');
		}

		$this->template->content = $view;

		if (($feed = Cache::instance()->get('feed')) === NULL)
		{
			// GitHub atom feed URL
			$url = 'https://github.com/goyote/docs/commits/master.atom';

			// Grab the 10 latest entries
			$entries = Feed::parse($url, 10);

			$feed = array();
			foreach ($entries as $entry)
			{
				$feed[] = array(
					'title' => $entry['title'],
					'href' => (string) $entry['link']['href'],
					'date' => Date::formatted_time($entry['updated'], 'n-d-Y'),
				);
			}

			// Cache the entries for 1 day
			Cache::instance()->set('feed', $feed, Date::DAY);
		}

		$this->template->set(array(
			'category' => ucwords(Inflector::humanize($category)),
			'article' => ucwords(Inflector::humanize($article)),
			'url' => array('category' => $category, 'article' => $article),
			'navigation' => $this->_config['navigation'],
			'resources' => Arr::path($this->_config, "resources.$category.$article"),
			'languages' => $this->_config['language']['supported'],
			'feed' => $feed,
		));
	}

} // End Controller_Docs

