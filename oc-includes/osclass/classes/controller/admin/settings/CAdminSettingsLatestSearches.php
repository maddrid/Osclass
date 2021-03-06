<?php

if (!defined('ABS_PATH')) {
    exit('ABS_PATH is not loaded. Direct access is not allowed.');
}

/*
 *  Copyright 2020 Osclass
 *  Maintained and supported by Mindstellar Community
 *  https://github.com/mindstellar/Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Class CAdminSettingsLatestSearches
 */
class CAdminSettingsLatestSearches extends AdminSecBaseModel
{

    public function __construct()
    {
        parent::__construct();
        osc_run_hook('init_admin_settings_latest');
    }

    //Business Layer...
    public function doModel()
    {
        switch ($this->action) {
            case ('latestsearches'):
                //calling the comments settings view
                $this->doView('settings/searches.php');
                break;
            case ('latestsearches_post'):
                // updating comment
                osc_csrf_check();
                if (Params::getParam('save_latest_searches') === 'on') {
                    osc_set_preference('save_latest_searches', 1);
                } else {
                    osc_set_preference('save_latest_searches', 0);
                }

                if (Params::getParam('customPurge') == '') {
                    osc_add_flash_error_message(_m('Custom number could not be left empty'), 'admin');
                    $this->redirectTo(osc_admin_base_url(true) . '?page=settings&action=latestsearches');
                } else {
                    osc_set_preference('purge_latest_searches', Params::getParam('customPurge'));

                    osc_add_flash_ok_message(_m('Last search settings have been updated'), 'admin');
                    $this->redirectTo(osc_admin_base_url(true) . '?page=settings&action=latestsearches');
                }
                break;
        }
    }
}

// EOF: ./oc-admin/controller/settings/CAdminSettingsLatestSearches.php
