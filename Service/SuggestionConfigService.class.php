<?php
/**
 * User: jayinton
 * Date: 2019/12/20
 * Time: 17:57
 */

namespace Suggestion\Service;


use System\Service\BaseService;

class SuggestionConfigService extends BaseService
{

    static function initConfig()
    {
        $config = [
            'contact_phone' => '',
            'enable_contact_phone' => 1,
        ];
        $res = D('Suggestion/SuggestionConfig')->add($config);
        if (!$res) {
            throw new \Exception('初始化失败');
        }
        return self::createReturn(true, null, '初始化完成');
    }

    /**
     * 根据ID获取
     *
     * @throws \Exception
     */
    static function getConfig()
    {
        $config = D('Suggestion/SuggestionConfig')->order('id desc')->find();
        if (empty($config)) {
            self::initConfig();
            return self::getConfig();
        }

        return self::createReturn(true, $config);
    }


    /**
     * 更新
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    static function updateItem($data = [])
    {
        $config = self::getConfig();
        $config = array_merge($config, $data);
        return self::update('Suggestion/SuggestionConfig', ['id' => $config['id']], $config);
    }

}