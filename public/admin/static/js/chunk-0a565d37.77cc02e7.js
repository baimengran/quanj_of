(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0a565d37"],{"0bd9":function(t,e,o){"use strict";o("935a")},1172:function(t,e,o){"use strict";var a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"createPost-container"},[o("el-form",{ref:"postForm",staticClass:"form-container",attrs:{model:t.postForm,rules:t.rules}},[o("sticky",{attrs:{"z-index":10,"class-name":"sub-navbar "+t.postForm.status}},[o("CommentDropdown",{model:{value:t.postForm.comment_disabled,callback:function(e){t.$set(t.postForm,"comment_disabled",e)},expression:"postForm.comment_disabled"}}),o("PlatformDropdown",{model:{value:t.postForm.platforms,callback:function(e){t.$set(t.postForm,"platforms",e)},expression:"postForm.platforms"}}),o("SourceUrlDropdown",{model:{value:t.postForm.source_uri,callback:function(e){t.$set(t.postForm,"source_uri",e)},expression:"postForm.source_uri"}}),o("el-button",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticStyle:{"margin-left":"10px"},attrs:{type:"success"},on:{click:t.submitForm}},[t._v(" Publish ")]),o("el-button",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],attrs:{type:"warning"},on:{click:t.draftForm}},[t._v(" Draft ")])],1),o("div",{staticClass:"createPost-main-container"},[o("el-row",[o("Warning"),o("el-col",{attrs:{span:24}},[o("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{prop:"title"}},[o("MDinput",{attrs:{maxlength:100,name:"name",required:""},model:{value:t.postForm.title,callback:function(e){t.$set(t.postForm,"title",e)},expression:"postForm.title"}},[t._v(" Title ")])],1),o("div",{staticClass:"postInfo-container"},[o("el-row",[o("el-col",{attrs:{span:8}},[o("el-form-item",{staticClass:"postInfo-container-item",attrs:{"label-width":"60px",label:"Author:"}},[o("el-select",{attrs:{"remote-method":t.getRemoteUserList,filterable:"","default-first-option":"",remote:"",placeholder:"Search user"},model:{value:t.postForm.author,callback:function(e){t.$set(t.postForm,"author",e)},expression:"postForm.author"}},t._l(t.userListOptions,(function(t,e){return o("el-option",{key:t+e,attrs:{label:t,value:t}})})),1)],1)],1),o("el-col",{attrs:{span:10}},[o("el-form-item",{staticClass:"postInfo-container-item",attrs:{"label-width":"120px",label:"Publish Time:"}},[o("el-date-picker",{attrs:{type:"datetime",format:"yyyy-MM-dd HH:mm:ss",placeholder:"Select date and time"},model:{value:t.displayTime,callback:function(e){t.displayTime=e},expression:"displayTime"}})],1)],1),o("el-col",{attrs:{span:6}},[o("el-form-item",{staticClass:"postInfo-container-item",attrs:{"label-width":"90px",label:"Importance:"}},[o("el-rate",{staticStyle:{display:"inline-block"},attrs:{max:3,colors:["#99A9BF","#F7BA2A","#FF9900"],"low-threshold":1,"high-threshold":3},model:{value:t.postForm.importance,callback:function(e){t.$set(t.postForm,"importance",e)},expression:"postForm.importance"}})],1)],1)],1)],1)],1)],1),o("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"70px",label:"Summary:"}},[o("el-input",{staticClass:"article-textarea",attrs:{rows:1,type:"textarea",autosize:"",placeholder:"Please enter the content"},model:{value:t.postForm.content_short,callback:function(e){t.$set(t.postForm,"content_short",e)},expression:"postForm.content_short"}}),o("span",{directives:[{name:"show",rawName:"v-show",value:t.contentShortLength,expression:"contentShortLength"}],staticClass:"word-counter"},[t._v(t._s(t.contentShortLength)+"words")])],1),o("el-form-item",{staticStyle:{"margin-bottom":"30px"},attrs:{prop:"content"}},[o("Tinymce",{ref:"editor",attrs:{height:400},model:{value:t.postForm.content,callback:function(e){t.$set(t.postForm,"content",e)},expression:"postForm.content"}})],1),o("el-form-item",{staticStyle:{"margin-bottom":"30px"},attrs:{prop:"image_uri"}},[o("Upload",{model:{value:t.postForm.image_uri,callback:function(e){t.$set(t.postForm,"image_uri",e)},expression:"postForm.image_uri"}})],1)],1)],1)],1)},n=[],i=(o("d81d"),o("b0c0"),o("8256")),s=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"upload-container"},[o("el-upload",{staticClass:"image-uploader",attrs:{data:t.dataObj,multiple:!1,"show-file-list":!1,"on-success":t.handleImageSuccess,drag:"",action:"https://httpbin.org/post"}},[o("i",{staticClass:"el-icon-upload"}),o("div",{staticClass:"el-upload__text"},[t._v(" 将文件拖到此处，或"),o("em",[t._v("点击上传")])])]),o("div",{staticClass:"image-preview image-app-preview"},[o("div",{directives:[{name:"show",rawName:"v-show",value:t.imageUrl.length>1,expression:"imageUrl.length>1"}],staticClass:"image-preview-wrapper"},[o("img",{attrs:{src:t.imageUrl}}),o("div",{staticClass:"image-preview-action"},[o("i",{staticClass:"el-icon-delete",on:{click:t.rmImage}})])])]),o("div",{staticClass:"image-preview"},[o("div",{directives:[{name:"show",rawName:"v-show",value:t.imageUrl.length>1,expression:"imageUrl.length>1"}],staticClass:"image-preview-wrapper"},[o("img",{attrs:{src:t.imageUrl}}),o("div",{staticClass:"image-preview-action"},[o("i",{staticClass:"el-icon-delete",on:{click:t.rmImage}})])])])],1)},r=[],l=(o("d3b7"),o("b775"));function c(){return Object(l["a"])({url:"/qiniu/upload/token",method:"get"})}var m={name:"SingleImageUpload3",props:{value:{type:String,default:""}},data:function(){return{tempUrl:"",dataObj:{token:"",key:""}}},computed:{imageUrl:function(){return this.value}},methods:{rmImage:function(){this.emitInput("")},emitInput:function(t){this.$emit("input",t)},handleImageSuccess:function(t){this.emitInput(t.files.file)},beforeUpload:function(){var t=this,e=this;return new Promise((function(o,a){c().then((function(a){var n=a.data.qiniu_key,i=a.data.qiniu_token;e._data.dataObj.token=i,e._data.dataObj.key=n,t.tempUrl=a.data.qiniu_url,o(!0)})).catch((function(t){console.log(t),a(!1)}))}))}}},u=m,p=(o("0bd9"),o("2877")),d=Object(p["a"])(u,s,r,!1,null,"0e0b11b7",null),f=d.exports,h=o("1aba"),g=o("b804"),b=o("61f7"),v=o("2423"),_=o("828d"),w=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},y=[function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("aside",[t._v(" Creating and editing pages cannot be cached by keep-alive because keep-alive include does not currently support caching based on routes, so it is currently cached based on component name. If you want to achieve a similar caching effect, you can use a browser caching scheme such as localStorage. Or do not use keep-alive include to cache all pages directly. See details "),o("a",{attrs:{href:"https://panjiachen.github.io/vue-element-admin-site/guide/essentials/tags-view.html",target:"_blank"}},[t._v("Document")])])}],F={},k=Object(p["a"])(F,w,y,!1,null,null,null),x=k.exports,C=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("el-dropdown",{attrs:{"show-timeout":100,trigger:"click"}},[o("el-button",{attrs:{plain:""}},[t._v(" "+t._s(t.comment_disabled?"Comment: closed":"Comment: opened")+" "),o("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),o("el-dropdown-menu",{staticClass:"no-padding",attrs:{slot:"dropdown"},slot:"dropdown"},[o("el-dropdown-item",[o("el-radio-group",{staticStyle:{padding:"10px"},model:{value:t.comment_disabled,callback:function(e){t.comment_disabled=e},expression:"comment_disabled"}},[o("el-radio",{attrs:{label:!0}},[t._v(" Close comment ")]),o("el-radio",{attrs:{label:!1}},[t._v(" Open comment ")])],1)],1)],1)],1)},O=[],$={props:{value:{type:Boolean,default:!1}},computed:{comment_disabled:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}}},S=$,j=Object(p["a"])(S,C,O,!1,null,null,null),U=j.exports,I=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("el-dropdown",{attrs:{"hide-on-click":!1,"show-timeout":100,trigger:"click"}},[o("el-button",{attrs:{plain:""}},[t._v(" Platfroms("+t._s(t.platforms.length)+") "),o("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),o("el-dropdown-menu",{staticClass:"no-border",attrs:{slot:"dropdown"},slot:"dropdown"},[o("el-checkbox-group",{staticStyle:{padding:"5px 15px"},model:{value:t.platforms,callback:function(e){t.platforms=e},expression:"platforms"}},t._l(t.platformsOptions,(function(e){return o("el-checkbox",{key:e.key,attrs:{label:e.key}},[t._v(" "+t._s(e.name)+" ")])})),1)],1)],1)},D=[],T={props:{value:{required:!0,default:function(){return[]},type:Array}},data:function(){return{platformsOptions:[{key:"a-platform",name:"a-platform"},{key:"b-platform",name:"b-platform"},{key:"c-platform",name:"c-platform"}]}},computed:{platforms:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}}},E=T,P=Object(p["a"])(E,I,D,!1,null,null,null),L=P.exports,A=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("el-dropdown",{attrs:{"show-timeout":100,trigger:"click"}},[o("el-button",{attrs:{plain:""}},[t._v(" Link "),o("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),o("el-dropdown-menu",{staticClass:"no-padding no-border",staticStyle:{width:"400px"},attrs:{slot:"dropdown"},slot:"dropdown"},[o("el-form-item",{staticStyle:{"margin-bottom":"0px"},attrs:{"label-width":"0px",prop:"source_uri"}},[o("el-input",{attrs:{placeholder:"Please enter the content"},model:{value:t.source_uri,callback:function(e){t.source_uri=e},expression:"source_uri"}},[o("template",{slot:"prepend"},[t._v(" URL ")])],2)],1)],1)],1)},q=[],R={props:{value:{type:String,default:""}},computed:{source_uri:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}}},N=R,V=Object(p["a"])(N,A,q,!1,null,null,null),B=V.exports,M={status:"draft",title:"",content:"",content_short:"",source_uri:"",image_uri:"",display_time:void 0,id:void 0,platforms:["a-platform"],comment_disabled:!1,importance:0},z={name:"ArticleDetail",components:{Tinymce:i["a"],MDinput:h["a"],Upload:f,Sticky:g["a"],Warning:x,CommentDropdown:U,PlatformDropdown:L,SourceUrlDropdown:B},props:{isEdit:{type:Boolean,default:!1}},data:function(){var t=this,e=function(e,o,a){""===o?(t.$message({message:e.field+"为必传项",type:"error"}),a(new Error(e.field+"为必传项"))):a()},o=function(e,o,a){o?Object(b["d"])(o)?a():(t.$message({message:"外链url填写不正确",type:"error"}),a(new Error("外链url填写不正确"))):a()};return{postForm:Object.assign({},M),loading:!1,userListOptions:[],rules:{image_uri:[{validator:e}],title:[{validator:e}],content:[{validator:e}],source_uri:[{validator:o,trigger:"blur"}]},tempRoute:{}}},computed:{contentShortLength:function(){return this.postForm.content_short.length},displayTime:{get:function(){return+new Date(this.postForm.display_time)},set:function(t){this.postForm.display_time=new Date(t)}}},created:function(){if(this.isEdit){var t=this.$route.params&&this.$route.params.id;this.fetchData(t)}this.tempRoute=Object.assign({},this.$route)},methods:{fetchData:function(t){var e=this;Object(v["b"])(t).then((function(t){e.postForm=t.data,e.postForm.title+="   Article Id:".concat(e.postForm.id),e.postForm.content_short+="   Article Id:".concat(e.postForm.id),e.setTagsViewTitle(),e.setPageTitle()})).catch((function(t){console.log(t)}))},setTagsViewTitle:function(){var t="Edit Article",e=Object.assign({},this.tempRoute,{title:"".concat(t,"-").concat(this.postForm.id)});this.$store.dispatch("tagsView/updateVisitedView",e)},setPageTitle:function(){var t="Edit Article";document.title="".concat(t," - ").concat(this.postForm.id)},submitForm:function(){var t=this;console.log(this.postForm),this.$refs.postForm.validate((function(e){if(!e)return console.log("error submit!!"),!1;t.loading=!0,t.$notify({title:"成功",message:"发布文章成功",type:"success",duration:2e3}),t.postForm.status="published",t.loading=!1}))},draftForm:function(){0!==this.postForm.content.length&&0!==this.postForm.title.length?(this.$message({message:"保存成功",type:"success",showClose:!0,duration:1e3}),this.postForm.status="draft"):this.$message({message:"请填写必要的标题和内容",type:"warning"})},getRemoteUserList:function(t){var e=this;Object(_["a"])(t).then((function(t){t.data.items&&(e.userListOptions=t.data.items.map((function(t){return t.name})))}))}}},H=z,J=(o("bafe"),Object(p["a"])(H,a,n,!1,null,"0fc03c47",null));e["a"]=J.exports},2423:function(t,e,o){"use strict";o.d(e,"c",(function(){return n})),o.d(e,"b",(function(){return i})),o.d(e,"d",(function(){return s})),o.d(e,"a",(function(){return r})),o.d(e,"e",(function(){return l}));var a=o("b775");function n(t){return Object(a["a"])({url:"/vue-element-admin/article/list",method:"get",params:t})}function i(t){return Object(a["a"])({url:"/vue-element-admin/article/detail",method:"get",params:{id:t}})}function s(t){return Object(a["a"])({url:"/vue-element-admin/article/pv",method:"get",params:{pv:t}})}function r(t){return Object(a["a"])({url:"/vue-element-admin/article/create",method:"post",data:t})}function l(t){return Object(a["a"])({url:"/vue-element-admin/article/update",method:"post",data:t})}},"41d9":function(t,e,o){},"828d":function(t,e,o){"use strict";o.d(e,"a",(function(){return n})),o.d(e,"b",(function(){return i}));var a=o("b775");function n(t){return Object(a["a"])({url:"/vue-element-admin/search/user",method:"get",params:{name:t}})}function i(t){return Object(a["a"])({url:"/vue-element-admin/transaction/list",method:"get",params:t})}},"935a":function(t,e,o){},bafe:function(t,e,o){"use strict";o("41d9")}}]);