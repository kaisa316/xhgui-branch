<?php
/**
 * Default configuration for Xhgui
 */
return array(
    'debug' => false,
    'mode' => 'development',
    /*
     * support extension: uprofiler, tideways_xhprof, tideways, xhprof
     * default: xhprof
     */
    'extension' => 'tideways_xhprof',

    // Can be either mongodb or file.
    /*
    'save.handler' => 'file',
    'save.handler.filename' => dirname(__DIR__) . '/cache/' . 'xhgui.data.' . microtime(true) . '_' . substr(md5($url), 0, 6),
    */
    'save.handler' => 'mongodb',

    // Needed for file save handler. Beware of file locking. You can adujst this file path
    // to reduce locking problems (eg uniqid, time ...)
    //'save.handler.filename' => __DIR__.'/../data/xhgui_'.date('Ymd').'.dat',
    'db.host' => 'mongodb://127.0.0.1:27017',
    'db.db' => 'xhprof',

    // Allows you to pass additional options like replicaSet to MongoClient.
    // 'username', 'password' and 'db' (where the user is added)
    'db.options' => array(),
    'templates.path' => dirname(__DIR__) . '/src/templates',
    'date.format' => 'Y-m-d H:i:s',
    'detail.count' => 6,
    'page.limit' => 25,

    // Profile 1 in 100 requests.
    // You can return true to profile every request.
    'profiler.enable' => function() {
		//return rand(1, 100) === 42;//system default
		$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
		if(strpos($_SERVER['REQUEST_URI'],'favicon.ico') !== false) {
			return false;//icon文件不参与	
		}
		if(strpos($url,'xhprof') !== false) {
			return false;//xhprof.com本身不参与
		}
		if (strpos($url, 'local') !== false) {
			return true;
		}
		//return rand(1, 100) === 42;
    },

    'profiler.simple_url' => function($url) {
        return preg_replace('/\=\d+/', '', $url);
    },

    'profiler.filter_path' => array(
        //'/home/admin/www/xhgui/webroot','F:/phpPro'
    )

);
