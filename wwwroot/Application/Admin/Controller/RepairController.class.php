<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 14:45
 */

namespace Admin\Controller;


class RepairController extends AdminController
{
    public function index(){
        $pid = i('get.pid', 0);
        /* 获取频道列表 */
       // $map  = array('status' => array('gt', -1), 'pid'=>$pid);
        $list = M('Repair')->select();

        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->meta_title = '导航管理';
        $this->display();
    }

    //添加
    public function add(){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();

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
            $this->display('add');
        }
    }

    //查看详情
    public function edit($id = 0)
    {
        $pid = i('get.pid', 0);
        $map  = array('id' =>$id, 'pid'=>$pid);
        $list = M('Repair')->where($map)->select();
        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->meta_title = '导航管理';
        $this->display('edit');
    }

    //删除
    public function del($id = 0){
        $map = array('id' => array('in', $id) );
        if(M('Repair')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}