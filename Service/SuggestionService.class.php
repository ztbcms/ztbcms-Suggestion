<?php
/**
 * User: jayinton
 * Date: 2019/12/20
 * Time: 17:57
 */

namespace Suggestion\Service;


use System\Service\BaseService;

class SuggestionService extends BaseService
{
    /**
     * 根据ID获取
     *
     * @param $id
     * @return array
     */
    static function getById($id) {
        return self::find('Suggestion/Suggestion', ['id' => $id]);
    }


    /**
     * 获取列表
     *
     * @param array  $where
     * @param string $order
     * @param int    $page
     * @param int    $limit
     * @param bool   $isRelation
     * @return array
     */
    static function getList($where = [], $order = '', $page = 1, $limit = 20, $isRelation = false) {
        $res =  self::select('Suggestion/Suggestion', $where, $order, $page, $limit, $isRelation);
        $items = $res['data']['items'];
        foreach ($items as $index => &$item){
            $item['images'] = json_decode($item['images']);
            $item['create_time_date'] = date('Y-m-d', $item['create_time']);
        }
        $res['data']['items'] = $items;
        return $res;
    }

    /**
     * 添加
     *
     * @param array $data
     * @return array
     */
    static function createItem($data = []) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        return self::create('Suggestion/Suggestion', $data);
    }

    /**
     * 更新
     *
     * @param       $id
     * @param array $data
     * @return array
     */
    static function updateItem($id, $data = []) {
        return self::update('Suggestion/Suggestion', ['id' => $id], $data);
    }

    /**
     * 删除
     *
     * @param $id
     * @return array
     */
    static function deleteItem($id) {
        return self::delete('Suggestion/Suggestion', ['id' => $id]);
    }
}