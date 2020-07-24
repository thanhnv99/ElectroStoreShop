<?php
//models/Pagination.php
//Class phan trang:
//Y tuong cua phan trang:
//gia su trong bang categories co 36 ban ghi va yeu cau la hien thi 10 ban ghi tren 1 trang
//->tong so trang can tao de chua het 36 ban ghi = ceil(36/10) = 4
//nhu vay can xac dinh cac tham so sau
//-tong so ban ghi : total
//-tong so ban ghi tren 1 trang : limit
//url phan trang se co dang sau,theo mo hinh mvc
//index.php?controller=category&action=index&page = 3
//-controller xu ly phan trang : controller
//-action xu ly phan trang:action
//che do hien thi phan trang : full_mode
class Pagination{
    //khai bao 1 thuoc tinh chua tat ca cac tham so vua liet ke
    public $params = [
        //tong so ban ghi tren trang
        'total' => 0,
        //gioi han ban ghi tren 1 trang
        'limit' => 0,
        //controller xu ly phan trang
        'controller' => '',
        //action xu ly phan trang
        'action' => '',
        //che do hien thi phan trang (show ra tat ca page hay khong )
        'full_mode' => FALSE
    ];
    //loi dung phuong thuc khoi tao cua class
    //de gan gia tri mac dinh cho thuoc tinh params vua khai bao
    public function __construct($params)
    {
        $this->params = $params;
    }

    //tao 1 phuong thuc lay tong so trang hien tai
    public function getTotalPage(){
        $total = $this->params['total'] / $this->params['limit'];
        //can lam tron len  vi co truong hop phep chia ra so thap phan
        $total = ceil($total);
        return $total;
    }

    //tao 1 phuong thuc lay ra trang hien tai
    public function getCurrentPage(){
        //url phan trang theo mo hinh MVC hien tai dang co dang index.php?controller=&action=&page=
        //khoi tao page mac dinh = 1
        $page = 1;
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
            //kiem tra neu user nhap thu cong ghi tri cho tham so page tren url ma > tong so trang dang co thi gan bien page = tong so trang
            $total_page = $this->getTotalPage();
            if($page >= $total_page){
                $page = $total_page;
            }
        }
        return $page;
    }

    //tao phuong thuc lay ra link HTML cua trang truoc do
    public function getPrevPage(){
        //can phan tich cau truc HTML nao se dung de xay dung ra phan trang
        //do he thong admin hien tai dang dung boostrap nen se sd cau truc ul li de dung phan trang
        $prev_page = '';
        //lay ra trang hien tai
        $current_page = $this->getCurrentPage();
        //link Prew chi hien thi khi trang hien tai >=2
        if($current_page >= 2){
            //lay ra gia tri cua controller va action tu thuoc tinh params
            $controller = $this->params['controller'];
            $action = $this->params['action'];
            $page = $current_page -1;
            $prev_url = "index.php?controller=$controller&action=$action&page=$page";
            //tao cau truc li cho bien $prev_page
            $prev_page = "<li><a href='$prev_url'>Prew</a></li>";
        }
        return $prev_page;
    }

    //xay dung phuong thuc tao ra link Next cho phan tang
    public function getNextPage(){
        $next_page = '';
        //lay ra so trang hien tai va tong so tang de check viec hien thi link next vi chi hien thi link next khi trang hien tai < tong so tang
        $current_page = $this->getCurrentPage();
        $total_page = $this->getTotalPage();
        if($current_page < $total_page){
            $controller = $this->params['controller'];
            $action = $this->params['action'];
            $page = $current_page + 1;
            $next_url = "index.php?controller=$controller&action=$action&page=$page";
            //tao cau truc li cho bien $prev_page
            $next_page = "<li><a href='$next_url'>Next</a></li>";
        }
        return $next_page;
    }

    //xay dung phuong thuc hien thi ra 1 cau truc HTML phan trang hoan chinh
    public function getPagination(){
        $data = '';
        //neu tong so trang hien tai chi = 1,thi khong can hien thi cau truc phan trang
        $total_page = $this->getTotalPage();
        if($total_page == 1){
            return '';
        }
        $data .= "<ul class='pagination'>";
        //gan link Prew vao dau tien
        $prev_link = $this->getPrevPage();
        $data .= $prev_link;

        //tao cac bien controller,action lay tu thuoc tinh params
        $controller = $this->params['controller'];
        $action = $this->params['action'];

        //neu nhu hien phan trang theo kieu ... ->full_mode = FALSE
        $full_mode = $this->params['full_mode'];
        if($this->params['full_mode'] == FALSE){
            $current_page = $this->getCurrentPage();
            for($page = 1; $page <= $total_page; $page++){
                //luon luon hien thi trang dau trang cuoi trang ngay trc va ngay sau trang hien tai
                if(in_array($page,[1, $total_page, $current_page-1, $current_page+1])){
                    $link = "index.php?controller=$controller&action=$action&page=$page";
                    $data .= "<li><a href='$link'>$page</a></li>";
                }
                //neu la trang hien tien thi se khong set link
                elseif ($page == $current_page){
                    $data .= "<li class='active'><a>$page</a></li>";
                }
                //neu la trang 2,3,trang cuoi-1,trang cuoi -2 thi se hien thi ki tu '...'
                elseif (in_array($page,[ 2, 3, $total_page-1, $total_page-2])){
                    $data .= "<li><a>...</a></li>";
                }
            }
        }
        //hien thi full page
        else{
            //chay vong lap tu 1 den tong so trang de hien thi ra cac trang
            for($page = 1;$page <= $total_page; $page++){
                $current_page = $this->getCurrentPage();
                //neu trang hien tai trung voi so lan lap hien tai thi se them class active va khong gan link cho trang hien tai
                if($current_page == $page){
                    $data .= "<li class='active'><a href='#'>$page</a></li>";
                }
                else
                {
                    $page_url = "index.php?controller=$controller&action=$action&page=$page";
                    $data .= "<li><a href='$page_url'>$page</a></li>";
                }
            }
        }

        //gan link Next vao cuoi cua cau truc phan trang
        $next_link = $this->getNextPage();
        $data .= $next_link;
        $data .= "</ul>";

        return $data;
    }
}