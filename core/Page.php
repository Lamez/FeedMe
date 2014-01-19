<?php
	class Page{
		private $title;
		private $path;
		private $query;
		private $person;
		private $show_crumbs;
		private $crumbs;
		private $crumb_size;
		private $messageArray;
		private $messageArraySize;
		//Person $person is not really needed, the only time it is called is in requireLogin(), so if you require a login to continue, you must pass the person obj.
		public function __construct($title = "", Person $person = NULL, $show_crumbs = false, $path = ""){
			$this->setQuery($_SERVER['QUERY_STRING']);
			$this->setTitle($title);
			$this->setPath($path);
			$this->setCrumbs($show_crumbs);
			$this->person = $person;
			$this->messageArray = array();
			$this->messageArraySize = 0;
			if($this->show_crumbs){ //No need to allocate memory if we are not going to show the curmbs, right?, RIGHT?
				$this->crumbs = array();
				$this->random();
				$this->crumb_size = 0; //keep up with the size of the array, so we don't have to call count() all the time.
			}
		}
		public function getURL(){
        	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        	$domainName = $_SERVER['HTTP_HOST'];
        	return $protocol.$domainName.dirname($_SERVER['PHP_SELF']);
		}
		public function setTitle($title){
			$this->title = $title;
		}
		public function getTitle(){
			return $this->title;
		}
		public function setCrumbs($show_crumbs){
			$this->show_crumbs = $show_crumbs;
		}
		public function showCrumbs(){
			return $this->show_crumbs;
		}
		public function setPath($path){
			$this->path = $path;
		}
		public function requireLogin(){ //For "Person $person" see Person.php in core/Person.php
			if(!$this->person->isAuth()){
				if(is_null($this->getQuery("page")))
					$this->addQuery("page", LOGIN_PAGE);
				else
					$this->changeQuery("page", LOGIN_PAGE);
				$this->addQuery("ref", $this->getCurrentPage());
				$this->redirect();
				exit;
			}
		}
		public function getThemePath(){
			return $this->path.THEME_CORE;
		}
		public function showHeader($simpleHeader = false){
			include($this->path.HEADER);
		}
		public function showFooter($simpleFooter = false){
			echo '<!-- Rendered Page -->';
			include ($this->path.FOOTER);
		}
		public function showBody($html){
			echo $html;
		}
		//<a href="install_1.php" class="bt blue large"><span class="glyph"></span>Next Step ></a>
		public function newButton($page, $class, $title, $addQuery = false){
			$return;
			if(!$addQuery)
				$return = '<a href="'.$page.'" class="'.$class.'"><span class="glyph"></span>'.$title.'</a>';
			else
				$return = '<a href="'.$page.'?'.$this->getQueryString().'" class="'.$class.'"><span class="glyph"></span>'.$title.'</a>';
			return $return;//heh
		}
		public function newAlert($title, $body, $color){
			  return '<div class="notification '.$color.'">
					<p><strong>'.$title.'</strong> '.$body.'</p>
					<a href="#" class="close">close</a>
				</div>';
		}
		public function newWidget($title, $body, $extra = "minimizable"){
			return '
			<div class="grid_12">
				<div class="widget '.$extra.'">
					'.$body.'
				</div>
			</div>
			';
		}
		public function newNotice($title, $message, $color){
			$msg = array();
			$msg["title"] = $title;
			$msg["message"] = $message;
			$msg["color"] = $color;
			$this->messageArray[$this->messageArraySize] = $msg;
			$this->messageArraySize++;			
		}
		private function printMessages(){ //see header.php
			foreach($this->messageArray as $msg){
				echo "
					$.feedback().addMessage({
                    	title: '".$msg["title"]."',
                        message: '".$msg["message"]."',
                        color: '".$msg["color"]."'
             		});
				";
			}
		}
		public function newMenuItem($title, $page, $icon, $external = false){
			$li = "";
			if($page == $this->getCurrentPage())
				$li = 'class="active"';
			if(!$external)
				$link = $this->makeLink("page", $page);
			else
				$link = $page;
			return '
				<li '.$li.'>
                	<a href="'.$link.'" title="'.$title.'" data-icon="'.$icon.'">'.$title.'</a>
               </li>';
		}
		public function newSubMenu($main_title, $titles = array(), $pages = array(), $icon){
			$li = "";
			$cp = $this->getCurrentPage();
			for($i=0; $i<count($pages); $i++){
				if($pages[$i] == $cp){
					$li = "active"; 
					break; //ouch, I hate doing this.
				}
			}
			$s = '<li class="with-submenu '.$li.'"><a href="#" title="'.$main_title.'" data-icon="'.$icon.'">'.$main_title.'</a><nav><ul>';
			for($i = 0; $i<count($titles); $i++)
				$s .= '<li><a href="'.$this->makeLink("page", $pages[$i]).'" title="'.$titles[$i].'">'.$titles[$i].'</a></li>';
            return $s.'</ul></nav></li>';
		}		
		/* Query Functions */
		private function setQuery($q){ //Only should be called within the class, outside modifiers may ruin exact results.
			$this->query = $q;
		}
		public function getQueryString(){
			return $this->query;
		}
		public function getQuery($get){
			if(isset($_GET[$get]))
				return $_GET[$get];
			else
				return NULL;
		}
		/*
		//This is an old getQuery function, then I relized I could just call $_GET, oh well..
		public function getQuery($get){
			parse_str($this->getQueryString(), $out);
			if(array_key_exists($get, $out))
				return $out[$get];
			else
				return NULL;
		} */
		public function queryEqual($get, $value, $strict = false){ //This just checks to see if a query equals a value., not really needed.
			if(!$strict)
				return $this->getQuery($get) == $value;
			else
				return $this->getQuery($get) === $value;
		}
		public function changeQuery($get, $var){
			parse_str($this->getQueryString(), $out);
			if(array_key_exists($get, $out)){
				$out[$get] = $var;
				$this->setQuery(http_build_query($out));
			}else
				$this->addQuery($get, $var);
		}
		public function removeQuery($get){
			parse_str($this->getQueryString(), $out);
			if(array_key_exists($get, $out)){ 
				unset($out[$get]);
				$this->setQuery(http_build_query($out));
			}
		}
		public function removeAllQuerys(){//I know, I know Querys should be Queries, but I think keeping it this way may or maynot help
			$this->setQuery("");
		}
		public function addQuery($name, $query){
			parse_str($this->getQueryString(), $out);
			$out[$name] = $query;
			$this->setQuery(http_build_query($out));
		}
		public function getCurrentPage(){
			if(isset($_GET['page']))
				return $_GET['page'];
			else
				return DEFAULT_PAGE;
		}
		/* End Query Functions */
		/* function: makeLink - This function taks in a page name and the value for the page, $leave is an array that will leave only those queries and their values */
		public function makeLink($name, $value, $leave = array("dark")){ 
			parse_str($this->getQueryString(), $out);
				
			$newOut[$name] = $value; //Building up the new array that will returned.
			$keyArray = array_keys($out); //array to hold all the keys of the queryString
			for($i = 0; $i<count($leave); $i++){
				if(!is_null($this->getQuery($leave[$i]))){ //Lets check to see if this value is set.
					$keep = array_search($leave[$i], $keyArray); //this sees if a value is in a array and returns the index., sees if what we want to leave is in the keyArray.
					//$keyArray[$keep] should return something like "page" or "dark" or ?queryName=value "queryName"
					$newOut[$keyArray[$keep]] = $out[$keyArray[$keep]];
				}
			}
			return "?".http_build_query($newOut);
		}
		public function makeMultiLink($names = array(), $values = array(), $leave = array("dark")){
			$newOut = array();
			for($i = 0; $i<count($names); $i++){
				$newOut[$names[$i]] = $values[$i];
			}
			parse_str($this->getQueryString(), $out);
			$keyArray = array_keys($out);
			for($i = 0; $i<count($leave); $i++){
				if(!is_null($this->getQuery($leave[$i]))){ //Lets check to see if this value is set.
					$keep = array_search($leave[$i], $keyArray); //this sees if a value is in a array and returns the index., sees if what we want to leave is in the keyArray.
					//$keyArray[$keep] should return something like "page" or "dark" or ?queryName=value "queryName"
					$newOut[$keyArray[$keep]] = $out[$keyArray[$keep]];
				}
			}
			return "?".http_build_query($newOut);
		}
		public function refresh($includeQueries = true){
			$this->redirect($this->currentURL($includeQueries));
		}
		public function redirect($url = NULL){
			if(is_null($url))
				$url = "?".$this->getQueryString();
			header("Location: ".$url);
		}
		public function currentURL($includeQueries = true){
			$url = 'http://';
			if ($_SERVER["SERVER_PORT"] != "80") 
  				$url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
 			else
  				$url .= $_SERVER["SERVER_NAME"];
			if($includeQueries)
				$url .= $_SERVER["REQUEST_URI"];
			else
				$url .= $_SERVER["SCRIPT_NAME"];
			return $url;
		}
		/* Bread Crumb Operations */
		private function addCrumb($crumb, $i){
			$this->crumbs[$i] = $crumb; 
			$this->crumb_size++;
		}
		
		private function removeCrumb($i){
			unset($this->crumbs[$i]);
			$this->crumb_size--;
		}
		public function printCrumb($i){
			if($i < $this->crumb_count()) 
				echo $this->crumbs[$i];
			else
				echo "";
		}
		public function random(){
			$this->addCrumb("Page A", 0);
			$this->addCrumb("Page B", 1);
			$this->addCrumb("Page C", 2);
		}
		private function crumb_count(){
			return $this->crumb_size;
		}
	}
?>