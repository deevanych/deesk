(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      router: this.$router,
      types: []
    };
  },
  mounted: function mounted() {
    var self = this;
    header.loading = false;
    axios.get('/api/v1/issues/types').then(function (response) {
      self.types = response.data;
    });
  },
  methods: {},
  components: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0& ***!
  \***********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col" }, [
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c(
          "div",
          {
            staticClass: "col align-items-center d-flex justify-content-between"
          },
          [
            _c(
              "table",
              { staticClass: "table" },
              [
                _vm._m(1),
                _vm._v(" "),
                _vm._l(_vm.types, function(type) {
                  return _c("tr", { staticClass: "shadow-sm" }, [
                    _c("td", { staticClass: "text-center" }, [
                      _vm._v(_vm._s(type.id))
                    ]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(type.title))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(type.description))]),
                    _vm._v(" "),
                    _c("td", [_vm._v("324")])
                  ])
                })
              ],
              2
            )
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c(
        "div",
        {
          staticClass: "col align-items-center d-flex justify-content-between"
        },
        [
          _c("h3", { staticClass: "font-weight-bold d-inline-block mb-0" }, [
            _vm._v("Статусы")
          ]),
          _vm._v(" "),
          _c(
            "a",
            {
              staticClass:
                "button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active",
              attrs: { href: "/" }
            },
            [_vm._v("\n                    Добавить тип\n                ")]
          )
        ]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticClass: "text-center" }, [_vm._v("#")]),
      _vm._v(" "),
      _c("th", [_vm._v("Название")]),
      _vm._v(" "),
      _c("th", [_vm._v("Описание")]),
      _vm._v(" "),
      _c("th", [_vm._v("Управление")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/views/app/settings/issues/statuses.vue":
/*!**********************************************************!*\
  !*** ./resources/views/app/settings/issues/statuses.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./statuses.vue?vue&type=template&id=05bc77d0& */ "./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0&");
/* harmony import */ var _statuses_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./statuses.vue?vue&type=script&lang=js& */ "./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _statuses_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/views/app/settings/issues/statuses.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_statuses_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./statuses.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/statuses.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_statuses_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0&":
/*!*****************************************************************************************!*\
  !*** ./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./statuses.vue?vue&type=template&id=05bc77d0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/statuses.vue?vue&type=template&id=05bc77d0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_statuses_vue_vue_type_template_id_05bc77d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);