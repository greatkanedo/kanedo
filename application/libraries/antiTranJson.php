class antiTranJson
{
  protected  static function jsonToArray($json)
  {
    if(!is_string($json) || is_null(json_decode($json, true)))
      throw new NotJsonStringException('param is not a json string');
    $deJson = json_decode($json, true);
    return self::toArray($deJson);
  }
  protected  static function stdClassToArray($stds)
  {
    if(is_object($stds))
      throw new NotObjectException('params not object');
    $params = get_object_vars($stds);
    return self::toArray($params);
  }
  protected  static function arrayRToArray($params)
  {
    $tmp = array();
    if(!is_array($params))
      throw new NotArrayException('params not array');
    foreach($params as $k=>$v)
    {
      $tmp[$k] = self::toArray($v);
    }
    //var_dump($tmp);
    return $tmp;
  }
  //调用这个方法，包含json的数据均可以被转换
  public static function toArray($params)
  {
    $tmp = array();
    if(is_string($params) && !is_null(json_decode($params)))
      $tmp = self::jsonToArray($params);
    elseif(is_array($params))
      $tmp = self::arrayRToArray($params);
    //这里注意一下，假如$params 是一个对象，只有包含的属性是可读取（public或者临时的对象属性）的时候才能实现转换
    elseif(is_object($params))
      $tmp = self::stdClassToArray($params);
    else
      $tmp = $params;
    return $tmp;
  }