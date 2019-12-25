<extend name="../../Admin/View/Common/element_layout"/>

<block name="content">
    <div id="app" style="padding: 8px;" v-cloak>
        <el-card>
            <h3></h3>
            <div class="filter-container">
                <el-form :model="form">
                    <el-form-item label="联系电话" label-width="80px" >
                        <el-input v-model="form.contact_phone" style="width: 400px" placeholder="请输入内容"></el-input>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" @click="doEdit">保存</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </el-card>
    </div>

    <style>
        .filter-container {
            padding-bottom: 10px;
        }
    </style>

    <script>
        $(document).ready(function () {
            new Vue({
                el: '#app',
                data: {
                    activeName: "1",
                    form: {
                        id: '{:I("get.id")}',
                        contact_phone: '',
                        enable_contact_phone: '',
                    },
                },
                watch: {},
                filters: {},
                methods: {
                    clickTabs: function(tab){},
                    doEdit: function () {
                        var that = this;
                        $.ajax({
                            url: "/Suggestion/SuggestionConfigManage/doEdit",
                            type: "post",
                            dataType: "json",
                            data: that.form,
                            success: function(res){
                                if(res.status){
                                    layer.msg('操作成功');
                                    if (window !== window.parent) {
                                        setTimeout(function () {
                                            window.parent.layer.closeAll();
                                        }, 1000);
                                    }
                                }else{
                                    layer.msg(res.msg)
                                }
                            }
                        });
                    },
                    getDetail: function () {
                        var that = this;
                        $.ajax({
                            url: "/Suggestion/SuggestionConfigManage/getDetail",
                            type: "get",
                            dataType: "json",
                            success: function(res){
                                console.log(res)
                                if(res.status){
                                    that.form = res.data
                                }else{
                                    layer.msg(res.msg)
                                }
                            }
                        });
                    },
                },
                mounted: function () {
                    this.getDetail()
                },
            })
        })
    </script>
</block>

