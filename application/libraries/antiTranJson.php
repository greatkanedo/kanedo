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
  //�����������������json�����ݾ����Ա�ת��
  public static function toArray($params)
  {
    $tmp = array();
    if(is_string($params) && !is_null(json_decode($params)))
      $tmp = self::jsonToArray($params);
    elseif(is_array($params))
      $tmp = self::arrayRToArray($params);
    //����ע��һ�£�����$params ��һ������ֻ�а����������ǿɶ�ȡ��public������ʱ�Ķ������ԣ���ʱ�����ʵ��ת��
    elseif(is_object($params))
      $tmp = self::stdClassToArray($params);
    else
      $tmp = $params;
    return $tmp;
  }