<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/11
 * Time: 15:11
 */

namespace Home\Controller;


use Admin\Model\RepairModel;

class RepairController extends HomeController
{
    //小区通知
    public function notice(){
        $model=M('document')->alias('d')->join('onethink_picture p  ON d.cover_id = p.id')->select();
        $this->assign('list', $model);
        $this->display();
    }

    //小区详情表
    public function article($id){
        $map  = array('id' =>$id);
        $list = M('DocumentArticle')->where($map)->select();
        //var_dump($list);exit;
        $this->assign('list', $list);

        $this->display('detail');
    }

    //在线报修
    public function xiu(){
        if(IS_POST){
            //$Repair=new RepairModel();
            $Repair = D('Repair');
            $data = $Repair->create();
            //var_dump($data);exit;
            if($data){
                $md5=md5(rand(1,50));
                $Repair->sn=$md5;
                $Repair->time=date('Y-m-d H:i:s',time());
                $Repair->state=0;
                $id = $Repair->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Repair->getError());
            }
        } else {
            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Repair')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->meta_title = '新增报修';
            $this->display('online');
        }

    }

}