<?php
/**
 * User: jayinton
 * Date: 2019/12/21
 * Time: 21:17
 */

namespace Suggestion\Controller;


use Common\Controller\AdminBase;
use Suggestion\Service\SuggestionService;

class SuggestionManageController extends AdminBase
{
    function lists()
    {
        $this->display();
    }

    function edit()
    {
        $this->display();
    }

    function doEdit()
    {
        $data = I('post.');
        $data['detail_url'] = I('post.detail_url', '', '');
        if (empty($data['id'])) {
            $data['create_time'] = time();
            $data['update_time'] = time();
            $res = SuggestionService::createItem($data);
        } else {
            $id = $data['id'];
            unset($data['id']);
            $data['update_time'] = time();
            $res = SuggestionService::updateItem($id, $data);
        }
        $this->ajaxReturn($res);
    }

    function doDelete()
    {
        $id = I('post.id');
        $res = SuggestionService::deleteItem($id);
        $this->ajaxReturn($res);
    }

    function getDetail()
    {
        $id = I('id');
        $res = SuggestionService::getById($id);
        $this->ajaxReturn($res);
    }

    function getList()
    {
        $name = I('title', '');
        $page = I('page', 1);
        $limit = I('limit', 15);
        $res = SuggestionService::getList([], 'id desc', $page, $limit);
        $this->ajaxReturn($res);
    }

}