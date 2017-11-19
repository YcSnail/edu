/**
 * 获取系统时间
 * @returns {string}
 */
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";

    // 判断时候 小于10
    var month = gtZero(date.getMonth() + 1 );
    var strDay = gtZero( date.getDate() );
    var Hours = gtZero( date.getHours() );
    var Minutes = gtZero( date.getMinutes() );


    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDay
        + " " + Hours + seperator2 + Minutes;
    return currentdate;
};

/**
 * 判断是否大于零
 */
function gtZero(num) {

    if (num >= 0 && num <= 9){
        num = "0" + num;
    }
    return num;
}


layui.use('layer', function(){
    layer = layui.layer;
});


/**
 * 显示遮罩层
 * @constructor
 */

function MaskShow() {

    createMsk();
    $('.loading').show();

    // 设置超时函数
    MaskNotic = window.setTimeout(MaskNotic,6000);
    $('.loading').click(function () {
        MaskClose();
    });
}


// 设置超时提示
function MaskNotic() {
    layer.msg('获取数据超时,请重试');
    MaskClose();
}

/**
 * 关闭 遮罩层
 * @constructor
 */
function MaskClose() {
    $('.loading').remove();
    $('.loading').hide();
    clearInterval(MaskNotic);
}


/**
 * 遮罩层
 */
function createMsk() {
    mask =
        '<div class="loading" style="display: none;">'+
            '<div class="loading-backdrop" style="opacity:1;"></div>'+
                '<div class="spinner"">'+
                '<div class="rect1"></div>'+
                '<div class="rect2"></div>'+
                '<div class="rect3"></div>'+
                '<div class="rect4"></div>'+
                '<div class="rect5"></div>'+
                '<p style="font-size: 12px;color: #ffffff;">正在加载</p>'+
            '</div>'+
        '</div>';
    $('body').append(mask);
}

/**
 * 获取 swith 的值
 * @param slider
 * @param setStuts
 * @returns {Array}
 */
function getSwithVal(slider){

    var saveArr = [];
    var tmpArr = [];

    var status = true;

    for (i=0;i<slider.length;i++){

        status = $('.'+slider[i]).hasClass('mui-active');

        tmpArr[0] = slider[i];

        if (status){
            tmpArr[1] = 'Y';
        }else{
            tmpArr[1] = 'N';
        }

        saveArr[i] = tmpArr;
        tmpArr = [];
    }

    return saveArr;
};


/**
 * 根据数组 取值,并返回
 * @param array
 * @returns {Array}
 */
function getClassValArr(array,checkArr) {

    var seveArr = [];
    var tmpArr = [];

    for (i=0;i<array.length;i++){

        tmpArr[0] = array[i];
        tmpArr[1] = $('.' + array[i]).val();

        if (tmpArr[1] == '' || tmpArr[1] == undefined){

            // 过滤特殊情况
            checkArrRes = jQuery.inArray(tmpArr[0],checkArr);

            if (checkArrRes < 0){
                msg = $('.'+ tmpArr[0]).parent().prev().text();
                if (msg ==''){
                    msg = tmpArr[0];
                }

                layer.msg(msg+' 不能为空');
                break;
            }

        }

        seveArr[i] = tmpArr;
        tmpArr = [];
    }

    // 判断是否相同
    if (seveArr.length !== array.length){
        return false;
    }

    return seveArr;
};



// 获取 classText 的值
function getClassText(array,checkArr) {

    var seveArr = [];
    var tmpArr = [];

    for (i=0;i<array.length;i++){

        tmpArr[0] = array[i];
        tmpArr[1] = $('.' + array[i]).text();

        if (tmpArr[1] == '' || tmpArr[1] == undefined){

            // 过滤特殊情况
            checkArrRes = jQuery.inArray(tmpArr[0],checkArr);

            if (checkArrRes < 0){
                msg = $('.'+ tmpArr[0]).prev().text();
                if (msg ==''){
                    msg = tmpArr[0];
                }
                layer.msg(msg+' 不能为空');
                break;
            }

        }

        seveArr[i] = tmpArr;
        tmpArr = [];
    }

    // 判断是否相同
    if (seveArr.length !== array.length){
        return false;
    }

    return seveArr;
}

/**
 *
 * @param value
 * @param msg
 * @returns {boolean}
 */
function checkEmpty(value,msg) {

    if (value == null || value =='' || value == 0){
        layer.msg(msg+'不能为空');
        return false;
    }
    return value;
}

/**
 * 合并数组 并转换为字符串
 * @param arr
 * @returns {*}
 */
function mergeArr(arr) {

    if (arr.length <= 0){
        return false;
    }

    var saveArr = [];
    // 循环合并数组
    for (i=0;i <arr.length;i++){
        // 合并数组
        saveArr = saveArr.concat(arr[i]);
    }
    // 数组转 字符串
    saveStr = saveArr.join(";");
    return saveStr;
}

/**
 * 设置获取的 对象数据
 * @param obj
 * @param checkArr
 * @param isArr
 * @returns {boolean}
 */
function setGetData(obj, checkArr,isArr) {


    var filterArr = filterObj(obj, checkArr);

    if (!filterArr) {
        return false;
    }

    var setGetDataArrRes = setGetDataArr(filterArr,isArr);

    if (setGetDataArrRes) {
        return true;
    }

    return false;
}


/**
 * 过滤返回数据
 * @param obj
 * @param checkArr
 * @returns {Array}
 */
function filterObj(obj,checkArr) {

    var tmpArr = [];
    var arr = [];
    jQuery.each(obj, function(i, val) {

        if (checkArr != undefined || checkArr != ''){
            checkArrRes = jQuery.inArray(i,checkArr);
            if (checkArrRes >=0){
                arr[0] = i;
                arr[1] = val;
                tmpArr.push(arr);
                arr = [];
            }
        }else{
            arr[0] = i;
            arr[1] = val;
            tmpArr.push(arr);
            arr = [];
        }

    });

    return tmpArr;

}

// 修改获取数据后 页面的值
function setGetDataArr(data,isArr) {

    if (data.length <=0){
        return false;
    }

    for (i=0;i<data.length;i++){

        if (isArr == true){
            $('.'+data[i][0]).text(data[i][1]);
        }else{
            $('.'+data[i][0]).val(data[i][1]);
        }

    }

    return true;
}


/**
 * 根据clasname 名字 修改值
 * @param classNameArr
 * @param valueArr
 */
function replaseData(classNameArr,valueArr) {

    for (i=0;i<classNameArr.length;i++){
        $('.'+ classNameArr[i]).val(valueArr[i]);
    }

}

/**
 * 刷新页面
 * @param time
 */
function webReload(msg,time) {

    if (!time){
        time = 2;
    }

    var showMsg = msg ? msg : '保存成功';

    layer.msg(showMsg +time+' S 后刷新页面');
    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
        window.location.reload();//页面刷新
    },time*1000);

}
