<?php

/**
 * 分页函数
 * @param  $nowPage  int  当前页
 * @param  $totalPage  int  总页数
 * @param  $url  string  跳转的连接，例：http://www.home.com/class/day2/code/page.php?xxx=xxx&xxx=xxx&page
 */
function pageHtml($nowPage, $totalPage, $url){ 
    
    #构建左半边部分
    //左半边需要的参数
    $preOnePage = $nowPage-1;//当前页的上一页
    $preTwoPage = $nowPage-2;//当前页的上上页

    if( $nowPage==1 ){//当前页为左边界
        $leftHtml = "";
    }elseif( $preOnePage==1 ) {//当前页的上一页为左边界
        $leftHtml = "<li><a href='$url=$preOnePage'>上一页</a></li> ";
        $leftHtml .= "<li><a href='$url=$preOnePage'>$preOnePage</a></li> ";
    }elseif( $preTwoPage==1 ) {//当前页的上上页为左边界
        $leftHtml = "<li><a href='$url=$preOnePage'>上一页</a></li> ";
        $leftHtml .= "<li><a href='$url=$preTwoPage'>$preTwoPage</a></li> ";
        $leftHtml .= "<li><a href='$url=$preOnePage'>$preOnePage</a></li> ";
    }else{//其他情况
        $leftHtml = "<li><a href='$url=$preOnePage'>上一页</a></li> ";
        $leftHtml .= "... ";
        $leftHtml .= "<li><a href='$url=$preTwoPage'>$preTwoPage</a></li> ";
        $leftHtml .= "<li><a href='$url=$preOnePage'>$preOnePage</a></li> ";
    }

    #构建当前页部分
    $nowHtml = "<li><a href='$url=$nowPage' style='color:red;'>$nowPage</a></li> ";

    #构建右半边的部分
    //右半边需要的参数
    $nextOnePage = $nowPage+1;//当前页的下一页
    $nextTwoPage = $nowPage+2;//当前页的下下页

    if( $nowPage==$totalPage ){//当前页为右边界
        $rightHtml = "";
    }elseif( $nextOnePage==$totalPage ) {//当前页的下一页为右边界
        $rightHtml = "<li><a href='$url=$nextOnePage'>$nextOnePage</a></li> ";
        $rightHtml .= "<li><a href='$url=$nextOnePage'>下一页</a></li> ";
    }elseif( $nextTwoPage==$totalPage ) {//当前页的下下页为右边界
        $rightHtml = "<li><a href='$url=$nextOnePage'>$nextOnePage</a></li> ";
        $rightHtml .= "<li><a href='$url=$nextTwoPage'>$nextTwoPage</a></li> ";
        $rightHtml .= "<li><a href='$url=$nextOnePage'>下一页</a></li> ";
    }else{//其他情况
        $rightHtml = "<li><a href='$url=$nextOnePage'>$nextOnePage</a></li> ";
        $rightHtml .= "<li><a href='$url=$nextTwoPage'>$nextTwoPage</a></li> ";
        $rightHtml .= "... ";
        $rightHtml .= "<li><a href='$url=$nextOnePage'>下一页</a></li> ";
    }

    //拼接分页HTML
    $pageHtml = $leftHtml . $nowHtml . $rightHtml;

    return $pageHtml;
    
}
