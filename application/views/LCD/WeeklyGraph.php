<!-- BEGIN Page Wrapper -->

<style>
        #pic {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            width:100%
        }

        .responsive {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
        }
    </style>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->

<!-- END Quick Menu -->
<!-- BEGIN Messenger -->



<!-- END Messenger -->
<!-- BEGIN Page Settings -->

<!-- END Page Settings -->
<!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
<script src="<?php echo base_url(); ?>assets/js/vendors.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.bundle.js"></script>
<script type="text/javascript">
    /* Activate smart panels */
    $('#js-page-content').smartPanel();
</script>
<!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
<script src="<?php echo base_url(); ?>/assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/data.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/drilldown.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/highcharts-more.js"></script>



<script>
    /* defined datas */
    var dataTargetProfit = [
        [1354586000000, 153],
        [1364587000000, 658],
        [1374588000000, 198],
        [1384589000000, 663],
        [1394590000000, 801],
        [1404591000000, 1080],
        [1414592000000, 353],
        [1424593000000, 749],
        [1434594000000, 523],
        [1444595000000, 258],
        [1454596000000, 688],
        [1464597000000, 364]
    ]
    var dataProfit = [
        [1354586000000, 53],
        [1364587000000, 65],
        [1374588000000, 98],
        [1384589000000, 83],
        [1394590000000, 980],
        [1404591000000, 808],
        [1414592000000, 720],
        [1424593000000, 674],
        [1434594000000, 23],
        [1444595000000, 79],
        [1454596000000, 88],
        [1464597000000, 36]
    ]
    var dataSignups = [
        [1354586000000, 647],
        [1364587000000, 435],
        [1374588000000, 784],
        [1384589000000, 346],
        [1394590000000, 487],
        [1404591000000, 463],
        [1414592000000, 479],
        [1424593000000, 236],
        [1434594000000, 843],
        [1444595000000, 657],
        [1454596000000, 241],
        [1464597000000, 341]
    ]
    var dataSet1 = [
        [0, 10],
        [100, 8],
        [200, 7],
        [300, 5],
        [400, 4],
        [500, 6],
        [600, 3],
        [700, 2]
    ];
    var dataSet2 = [
        [0, 9],
        [100, 6],
        [200, 5],
        [300, 3],
        [400, 3],
        [500, 5],
        [600, 2],
        [700, 1]
    ];
</script>
<script>

    $(document).ready(function() {




        function generateDataTopWeek(data1) {

            var ret = {},
                ps = [],
                series = [],
                len = data1.BarDatalastWeek.length;
            let newarr = []

            // console.log("Outer", data1);
            //concat to get points

            for (let i = 0; i < len; i++) {
                for (let j = i + 1; j < len; j++) {
                    if (data1.BarDatalastWeek[i].ClassPercentage < data1.BarDatalastWeek[j].ClassPercentage) {
                        var temp = data1.BarDatalastWeek[i];
                        data1.BarDatalastWeek[i] = data1.BarDatalastWeek[j]
                        data1.BarDatalastWeek[j] = temp;
                    }
                }
            }

            for (var i = 0; i < len; i++) {

                let color;

                switch (i) {
                    case 0:
                    case 1:
                        color = 'green';
                        break;


                    case len - 1:
                    case len - 2:
                        color = 'red';
                        break;

                    default:
                        color = 'blue';
                        break;



                }

                ps[i] = {
                    name: data1.BarDatalastWeek[i].DeptName,
                    y: parseInt(data1.BarDatalastWeek[i].ClassPercentage),
                    drilldown: data1.BarDatalastWeek[i].DeptName,
                    color: color

                };
            }

            names = [];
            //generate series and split points
            for (i = 0; i < len; i++) {

                var p = ps[i];

                series.push(p);
            }
            return [series];
        }


        // function generateDataBottomWeek(data1) {

        //     var ret = {},
        //         ps = [],
        //         series = [],
        //         len = data1.BarDatabottomlastWeek.length;
        //     let datesArray = []
        //     let dataArray = []

        //     //concat to get points
        //     for (var i = 0; i < len; i++) {
        //         if (datesArray.indexOf(data1.BarDatabottomlastWeek[i].DeptName) === -1) {
        //             datesArray.push(data1.BarDatabottomlastWeek[i].DeptName)
        //             dataArray.push([data1.BarDatabottomlastWeek[i].DeptName, data1.BarDatabottomlastWeek[i].Class, parseInt(data1.BarDatabottomlastWeek[i].ClassPercentage)

        //             ])
        //         } else {
        //             dataArray.push([data1.BarDatabottomlastWeek[i].DeptName, data1.BarDatabottomlastWeek[i].Class, parseInt(data1.BarDatabottomlastWeek[i].ClassPercentage)

        //             ])
        //         }



        //     }



        //     //generate series and split points
        //     for (i = 0; i < datesArray.length; i++) {
        //         let OriginaldataArray = []
        //         let OriginaldataArrayDateRemove = []
        //         dataArray.filter(function(e) {
        //             if (e[0] === datesArray[i]) {
        //                 OriginaldataArray.push(e)
        //             }
        //         });
        //         OriginaldataArray.forEach(element => {
        //             // console.log("Element", element)
        //             element.shift()
        //             OriginaldataArrayDateRemove.push(element)
        //         });
        //         // console.log("data Get", OriginaldataArray)
        //         var p = {
        //             name: datesArray[i],
        //             id: datesArray[i],
        //             data: OriginaldataArrayDateRemove
        //         }
        //         //  console.log("Series", p)
        //         series.push(p);
        //     }
        //     return series;
        // }












        //weekly
        (function() {

            let datesArray = []
            let url = "<?php echo base_url('lcd/getPrayersDataweekly') ?>";
            $.get(url, function(data, status) {
                // console.log("All Data", data)
                let seriesDataTop;
                let seriesDataTopweek;

                let seriesDataBottom;
                let dataArrayOuter = data.BarData
                if (data) {
                    seriesDataTopweek = generateDataTopWeek(data)
                    // seriesDataBottomweek = generateDataBottomWeek(data)




                }
                // console.log("Target", datesArrayMachineWise)

                for (var i = 0; i < data.BarDatalastWeek.length; i++) {
                    if (datesArray.indexOf(data.BarDatalastWeek[i].Date) === -1) {
                        datesArray.push(data.BarDatalastWeek[i].Date)
                    }
                }



                Highcharts.chart('weekPrayersData', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: `Weekly Prayers Percentage`
                    },
                    // subtitle: {
                    //     align: 'center',
                    //     text: `Weekly Prayers Data`
                    // },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Prayers Percentage'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}%'
                            },
                            cursor: 'pointer',
                        }
                    },

                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>%<br/>'
                    },

                    series: [{
                        colorByPoint: true,
                        data: seriesDataTopweek[0]
                    }],
                    // drilldown: {
                    //     breadcrumbs: {
                    //         position: {
                    //             align: 'right'
                    //         }
                    //     },
                    //     series: seriesDataBottomweek
                    // }
                });






            });
        })();

        setTimeout(function(){
            document.getElementById('weekPrayersData').style.display='none';
            document.getElementById('pic').style.display='block';

        },20000)
        

        var urlSearchParams = new URLSearchParams(window.location.search);
        var param = urlSearchParams.get("param");

        if (param == 'TM1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/TM/FinalQC/';
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'TM2') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/TM/Forming/B34002Pass'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'TMS1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/sports/Packing_Slide/TM_Packing'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'TMS2') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/sports/Ball_Forming/BallForming'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'TMS3') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/sports/TabsC/TabDirection1'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'rwpd1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/TM/rwpd/index'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'amb1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/amb/line1/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'amb2') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/amb/line3/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'amb3') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/amb/line4/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'amb4') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/amb/line5/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'Mline1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Mline1/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'Mline3') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Mline3/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'Mline5') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Mline5/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'Mline7') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Mline7/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline1') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line1/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline3') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line3/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline5') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line5/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline7') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line7/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline9') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line9/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline11') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line11/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline13') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line13/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline15') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line15/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline17') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line17/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline19') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line19/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else if (param == 'MSline21') {
            setTimeout(function(){
            window.location='http://<?php echo $_SERVER['HTTP_HOST']; ?>/MS/Line21/'
            },40000)

            console.log("Value of 'c' parameter:", param);
        }
        else {
            // If "param" is not provided in the URL
            console.log("No 'param' parameter found in the URL.");
        }

    })
</script>

<div id="weekPrayersData" style="height: 100%;"></div>
<img id='pic' src="/Namaz/assets/img/Hadith/hadith.jpg" style="display: none;" class="responsive">
</body>

</html>