<?php
namespace Vking\Bazi;
use Overtrue\ChineseCalendar\Calendar;

class Fate
{
    protected $date,$isLeap,$noli;
    protected $data;
    protected $hour_gan = [
        '甲'=>'甲',
        '乙'=>'丙',
        '丙'=>'戊',
        '丁'=>'庚',
        '戊'=>'壬',
        '己'=>'甲',
        '庚'=>'丙',
        '辛'=>'戊',
        '壬'=>'庚',
        '癸'=>'壬'
    ];
    protected $Zhi = ['子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥'];
    protected $Gan_WX=['甲'=>'木','乙'=>'木','丙'=>'火','丁'=>'火','戊'=>'土','己'=>'土','庚'=>'金','辛'=>'金','壬'=>'水','癸'=>'水'];
    protected $Zhi_WX=['子'=>'水','丑'=>'土','寅'=>'木','卯'=>'木','辰'=>'土','巳'=>'火','午'=>'火','未'=>'土','申'=>'金','酉'=>'金','戌'=>'土','亥'=>'水'];

    public function __construct($date=null,$noli=false,$isLeap=false)
    {
        $this->calendar = new Calendar();
        if($date!=null)
            $this->set($date,$noli,$isLeap);
    }

    /**
     * @param $date
     *      string:YYYY-MM-DD-HH
     *      or
     *      int(10):timestamp
     * @param bool $noli 是否为农历，默认阳历（false）
     * @param bool $isLeap 是否为闰月，默认不是（false）
     */
    public function set($date="",$noli=false,$isLeap=false)
    {
        if(!$date) return;
        if(is_numeric($date)){
            $date=date("Y-m-d-H",$date);
        }
        $this->date = explode("-",$date);
        $this->noli = $noli;
        $this->isLeap = $isLeap;
        $this->__makeCalendarDate();
        $this->__makeHourGZ();
        $this->__makeGZWX();
    }
    protected function __makeCalendarDate(){
        if($this->noli){
            $this->data=$this->calendar->lunar($this->date[0],$this->date[1],$this->date[2],$this->isLeap);// 阴历
        }else{
            $this->data=$this->calendar->solar($this->date[0],$this->date[1],$this->date[2]);// 阳历
        }
    }
    protected function __makeHourGZ(){
        $dayG=mb_substr($this->data['ganzhi_day'],0,1,'UTF-8');
        $hour=!empty($this->date[3])?$this->date[3]:0;
        $hour_index=(int)(($hour+1)/2)%12;
        $this->data['ganzhi_hour']=$this->hour_gan[$dayG].$this->Zhi[$hour_index];
    }
    protected function __makeGZWX(){
        $ganzhi=$this->data['ganzhi_year'].$this->data['ganzhi_month']
            .$this->data['ganzhi_day'].$this->data['ganzhi_hour'];
        $gzwx=array();
        for($i=0;$i<8;$i++){
            $gz=mb_substr($ganzhi,$i,1,'UTF-8');
            if($i%2==0){
                $wx=$this->Gan_WX[$gz];
            }else{
                $wx=$this->Zhi_WX[$gz];
            }
            $gzwx[$i]=[$gz=>$wx];
        }
        $this->data['bazi_wuxing']=$gzwx;
    }
    public function get()
    {
        return $this->data;
    }
}