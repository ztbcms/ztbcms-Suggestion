<extend name="../../Admin/View/Common/element_layout"/>

<block name="content">
    <div id="app" style="padding: 8px;" v-cloak>
        <el-card>
            <h3></h3>
            <div class="filter-container">
                <el-tabs v-model="activeName" @tab-click="clickTabs">
                    <el-tab-pane label="基本信息" name="1">
                        <el-form :model="form">
                            <el-form-item label="标题" label-width="80px" >
                                <el-input v-model="form.title" style="width: 400px" placeholder="请输入内容"></el-input>
                            </el-form-item>


                            <el-form-item label="缩略图" label-width="80px">
                                <template slot-scope="scope">
                                    <div>
                                        <span>图片尺寸比例：1:1，支持 png,jpg 格式</span>
                                        <div>
                                            <el-image
                                                    v-if="form.thumb"
                                                    style="width: 100px; height: 100px"
                                                    :src="form.thumb">
                                            </el-image>
                                        </div>
                                        <el-button type="primary" @click="gotoUploadFile">上传缩略图</el-button>
                                    </div>
                                </template>
                            </el-form-item>

                            <el-form-item label="文章简介" label-width="80px">
                                <el-input v-model="form.description" style="width: 400px" placeholder="请输入内容"></el-input>
                            </el-form-item>
                            <el-form-item label="发布时间" label-width="80px" >
                                <el-date-picker
                                        v-model="form.release_date"
                                        value-format="yyyy-M-d"
                                        type="date"
                                        placeholder="选择日期">
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="文章链接" label-width="80px" >
                                <el-input v-model="form.detail_url" style="width: 400px" placeholder="请输入内容"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="doEdit">保存</el-button>
                            </el-form-item>
                        </el-form>

                    </el-tab-pane>

                </el-tabs>

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
                        title: '',
                        thumb: '',
                        description: '',
                        detail_url: '',
                        release_date: '',
                    },
                },
                watch: {},
                filters: {},
                methods: {
                    clickTabs: function(tab){},
                    doEdit: function () {
                        var that = this;
                        $.ajax({
                            url: "/News/NewsManage/doEdit",
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
                    getDetail: function (id) {
                        var that = this;
                        $.ajax({
                            url: "/News/NewsManage/getDetail?id="+id,
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
                    gotoUploadFile: function () {
                        this.pictureUploadStatus = 1;
                        layer.open({
                            type: 2,
                            title: '上传图片',
                            content: "{:U('Upload/UploadCenter/imageUploadPanel', ['max_upload' => 1])}",
                            area: ['90%', '90%'],
                        })
                    },
                    //上传缩略图处理
                    onUploadedFile: function (event) {
                        var that = this;
                        var files = event.detail.files;
                        if (files) {
                            that.form.thumb = files[0].url
                        }
                    },
                },
                mounted: function () {
                    //上传图片监听回调
                    window.addEventListener('ZTBCMS_UPLOAD_FILE', this.onUploadedFile.bind(this));
                    if(this.form.id){
                        this.getDetail(this.form.id)
                    }
                },
            })
        })
    </script>
</block>

