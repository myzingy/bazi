#八字命盘

目前功能

    根据阳历或阴历计算八字，根据八字天干地支显示命盘五行

后期功能

    1，命盘得分（命硬、命弱判断）
    2，喜神
    。。。
    
##Installing
    
    $ composer require vking/bazi -vvv
##Usage
    
    use Vking\Bazi;
    //阳历2017年08月31日 12时出生
    //$fate = new Fate(1234567890);//支持时间戳方式
    $fate = new Fate("2017-08-31-12");
    var_dump($fate->get());
    
    //阴历2017年08月31日 12时出生
    //$fate = new Fate("2017-08-31-12",true);
    $fate->set("2017-08-31-12",true);
    var_dump($fate->get());
    
    //阴历2017年润08月31日 12时出生
    //$fate = new Fate("2017-08-31-12",true,true);
    $fate->set("2017-08-31-12",true,true);
    var_dump($fate->get());
    
##Return
    {
        "lunar_year": 2017,                 // 农历年
        "lunar_month": 4,                   // 农历月
        "lunar_day": 10,                    // 农历日
        "lunar_month_chinese": "四月",       // (汉字)农历月
        "lunar_day_chinese": "初十",         // (汉字)农历日  
        "ganzhi_year": "丁酉",               // (干支)年
        "ganzhi_month": "乙巳",              // (干支)月
        "ganzhi_day": "壬辰",                // (干支)日
        "animal": "鸡",                      // 生肖
        "term": "立夏",                      // 节气
        "is_leap": false,                    // 是否为闰月
        "gregorian_year": 2017,              // 公历年
        "gregorian_month": 5,                // 公历月
        "gregorian_day": 5,                  // 公历日
        "week_no": 5,                        // (数字)星期几
        "week_name": "星期五",                // (汉字)星期几
        "is_today": false,                   // 是否为今天
        "constellation": "金牛"               // 星座
        "ganzhi_hour":"壬子"                  // (干支)时
        [bazi_wuxing] => [                   // 按年月日时的干支对应的五行
            [己] => 土,
            [丑] => 土,
            [丙] => 火,
            [寅] => 木,
            [庚] => 金,
            [寅] => 木,
            [丙] => 火,
            [辰] => 土
        ]
    }
    
##License

    MIT