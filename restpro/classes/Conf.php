<?php
  /**
   * Konfigurations-Klasse, die das korrekt Speichern und laden der conf.ini
   * verwaltet
   *
   * @author  David Krawec
   * @date    09.04.2017
   */
class Conf{
  private $aConf = [];
  private $sPath = '';

  public function __construct($filename){
    $this->sPath = $filename;
    $this->aConf = parse_ini_file( $filename, true);
  }

  public function getConf(){
    return $this->aConf;
  }

  public function setConf($aConf){
    $this->aConf = $aConf;
    $this->write_php_ini();
  }

  public function getPath(){
    return $this->aConf['website']['path'];
  }

  public function getDebugging(){
    return $this->aConf['website']['debugging'];
  }

  public function getAllowedFileTypes(){
    return $this->aConf['allowed_filetypes'];
  }

  public function DBIsSet(){
    if( $this->aConf['database']['db_ip']   == '' ||
        $this->aConf['database']['db_name'] == '' )
        return false;
    return true;
  }

  // Entnommen aus http://php.net/manual/de/function.parse-ini-file.php
  // Von freamer89 at gmail dot com
  // Anpassungen um die Funktion innerhalb einer Klasse benutzen zu können
  //
  // Diese Funktionen ermöglichen es, beliebige Konfigurations-Arrays in
  // eine Datei zurückzuschreiben, wir erhalten so persistente Konfigurationen
  private function write_php_ini()
  {
    $file = $this->sPath;
    $array = $this->aConf;

    $res = array();
    foreach($array as $key => $val)
    {
      if(is_array($val))
      {
        $res[] = "[$key]";
        foreach($val as $skey => $sval)
          $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
      }
      else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
    }
    $this->safefilerewrite($file, implode("\r\n", $res));
  }

  // Entnommen aus http://php.net/manual/de/function.parse-ini-file.php
  // Von freamer89 at gmail dot com
  // Anpassungen um die Funktion innerhalb einer Klasse benutzen zu können
  //
  // Diese Funktionen ermöglichen es, beliebige Konfigurations-Arrays in
  // eine Datei zurückzuschreiben, wir erhalten so persistente Konfigurationen
  private function safefilerewrite($fileName, $dataToSave)
  {
    if ($fp = fopen($fileName, 'w'))
    {
      $startTime = microtime();
      do
      {
        $canWrite = flock($fp, LOCK_EX);
        // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
        if(!$canWrite) usleep(round(rand(0, 100)*1000));
      } while ((!$canWrite)and((microtime()-$startTime) < 1000));

      //file was locked so now we can store information
      if ($canWrite)
      {
        fwrite($fp, $dataToSave);
        flock($fp, LOCK_UN);
      }
      fclose($fp);
    }
  }

}
?>
