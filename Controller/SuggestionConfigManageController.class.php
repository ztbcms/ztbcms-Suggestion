<?php
/**
 * User: jayinton
 * Date: 2019/12/21
 * Time: 21:17
 */

namespace Suggestion\Controller;


use Common\Controller\AdminBase;
use Suggestion\Service\SuggestionConfigService;
use Suggestion\Service\SuggestionService;

class SuggestionConfigManageController extends AdminBase
{
    function index()
    {
        $this->display();
    }

    /**
     * @throws \Exception
     */
    function doEdit()
    {
        $data = I('post.');
        $res = SuggestionConfigService::updateItem($data);
        $this->ajaxReturn($res);
    }

    /**
     * @throws \Exception
     */
    function getDetail()
    {
        $res = SuggestionConfigService::getConfig();
        $this->ajaxReturn($res);
    }



}