<?php
  /**
   * Sucht im Routen-Array nach der passenden Page
   * @param sURL    Die gesuchte URL
   * @param aRoutes Zu durchsuchendes Array
   * @author David Krawiec
   * @return &Page
   */
  function &get_page(&$sURL, &$aRoutes){
    $sURL = get_url($sURL);
    if(isset($aRoutes[$sURL]))
      return($aRoutes[$sURL]);
    return $aRoutes['/404'];
  }

  /**
   * get first part of URL
   * Example: url: localhost/active/setup -> Returns: /setup
   * @param sURL    URL-String
   * @author David Krawiec
   * @return String URL
   */
  function get_url(&$sURL){
    $aURL = explode('/', $sURL);
    return('/' . $aURL[1]);
  }

  /**
   * get second part of URL
   * Example: url: localhost/active/rest/login -> Returns: /login
   * @param sURL    URL-String
   * @author David Krawiec
   * @return String URL
   */
  function get_second_url(&$sURL){
    $aURL = explode('/', $sURL);
    return('/' . $aURL[2]);
  }

   /**
   * Search url for allowed filetypes
   * @param sURL                  URL-String
   * @param sALLOWED_FILETYPES    Array of allowed filetypes
   * @author David Krawiec
   * @return boolean true/false
   */
  function isAllowedFileType(&$sURL, &$ALLOWED_FILETYPES){
    $fileInfo = pathinfo($sURL);

    if(isset($fileInfo['extension']) &&
       isset($ALLOWED_FILETYPES[$fileInfo['extension']]) )
      return true;
    return false;
  }

   /**
   * Sends a http-header to user to get him to a new url
   * @param newLocation   Neue URL
   * @author David Krawiec
   * @return null
   */
  function rewriteLocation($newLocation){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri$newLocation");
    exit;
  }

   /**
   * send http-header to force a reload on the client side
   * @author David Krawiec
   * @return null
   */
  function refreshLocation(){
    header("Refresh: 0");
    exit;
  }
?>
