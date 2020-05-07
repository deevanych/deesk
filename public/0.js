(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
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
      types: null
    };
  },
  mounted: function mounted() {
    var self = this;
    header.loading = true;
    axios.get('/api/v1/issues/types').then(function (response) {
      header.loading = false;
      self.types = response.data;
    });
  },
  methods: {
    getDescription: function getDescription(text) {
      var size = 25;

      if (text.length > size) {
        return text.slice(0, size) + ' ...';
      }

      return text;
    }
  },
  components: {}
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.description[data-v-03225f0e] {\n    color: #a7a7a7;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
                _vm.types
                  ? _vm._l(_vm.types, function(type) {
                      return _c("tr", { staticClass: "shadow-sm" }, [
                        _c("td", { staticClass: "text-center" }, [
                          _vm._v(_vm._s(type.id))
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c("a", { attrs: { href: "#" } }, [
                            _vm._v(_vm._s(type.title))
                          ])
                        ]),
                        _vm._v(" "),
                        _c("td", { staticClass: "description" }, [
                          _vm._v(_vm._s(_vm.getDescription(type.description)))
                        ]),
                        _vm._v(" "),
                        _c("td", [
                          _c("span", [
                            _c(
                              "svg",
                              {
                                staticClass:
                                  "svg-inline--fa fa-check-square fa-w-14 fa-2x",
                                attrs: {
                                  "aria-hidden": "true",
                                  focusable: "false",
                                  "data-prefix": "far",
                                  "data-icon": "check-square",
                                  role: "img",
                                  height: "1rem",
                                  xmlns: "http://www.w3.org/2000/svg",
                                  viewBox: "0 0 448 512"
                                }
                              },
                              [
                                _c("path", {
                                  attrs: {
                                    fill: "currentColor",
                                    d:
                                      "M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm0 400H48V80h352v352zm-35.864-241.724L191.547 361.48c-4.705 4.667-12.303 4.637-16.97-.068l-90.781-91.516c-4.667-4.705-4.637-12.303.069-16.971l22.719-22.536c4.705-4.667 12.303-4.637 16.97.069l59.792 60.277 141.352-140.216c4.705-4.667 12.303-4.637 16.97.068l22.536 22.718c4.667 4.706 4.637 12.304-.068 16.971z"
                                  }
                                })
                              ]
                            )
                          ]),
                          _vm._v(" "),
                          _c("span", [
                            _c(
                              "svg",
                              {
                                staticClass:
                                  "svg-inline--fa fa-edit fa-w-18 fa-2x",
                                attrs: {
                                  "aria-hidden": "true",
                                  focusable: "false",
                                  "data-prefix": "far",
                                  "data-icon": "edit",
                                  role: "img",
                                  height: "1rem",
                                  xmlns: "http://www.w3.org/2000/svg",
                                  viewBox: "0 0 576 512"
                                }
                              },
                              [
                                _c("path", {
                                  attrs: {
                                    fill: "currentColor",
                                    d:
                                      "M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"
                                  }
                                })
                              ]
                            )
                          ]),
                          _vm._v(" "),
                          _c("span", [
                            _c(
                              "svg",
                              {
                                staticClass:
                                  "svg-inline--fa fa-trash-alt fa-w-14 fa-2x",
                                attrs: {
                                  "aria-hidden": "true",
                                  focusable: "false",
                                  "data-prefix": "far",
                                  "data-icon": "trash-alt",
                                  height: "1rem",
                                  role: "img",
                                  xmlns: "http://www.w3.org/2000/svg",
                                  viewBox: "0 0 448 512"
                                }
                              },
                              [
                                _c("path", {
                                  attrs: {
                                    fill: "currentColor",
                                    d:
                                      "M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"
                                  }
                                })
                              ]
                            )
                          ])
                        ])
                      ])
                    })
                  : _vm._l(4, function(n) {
                      return _c(
                        "tr",
                        _vm._l(4, function(n) {
                          return _c(
                            "td",
                            [
                              _c("PuSkeleton", {
                                attrs: { width: "100%", height: "1rem" }
                              })
                            ],
                            1
                          )
                        }),
                        0
                      )
                    })
              ],
              2
            )
          ]
        )
      ])
    ]),
    _vm._v(" "),
    _vm._m(2)
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
            _vm._v("Типы")
          ]),
          _vm._v(" "),
          _c(
            "a",
            {
              staticClass:
                "button p-3 px-4 rounded-pill shadow-sm tonight router-link-exact-active router-link-active",
              attrs: {
                href: "/",
                "data-toggle": "modal",
                "data-target": "#exampleModal"
              }
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
      _c("th")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "exampleModal",
          tabindex: "-1",
          role: "dialog",
          "aria-labelledby": "exampleModalLabel",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          {
            staticClass: "modal-dialog modal-dialog-centered ",
            attrs: { role: "document" }
          },
          [
            _c("div", { staticClass: "modal-content shadow-sm p-5" }, [
              _c("div", { staticClass: "modal-header p-0 border-0" }, [
                _c(
                  "h5",
                  {
                    staticClass: "modal-title",
                    attrs: { id: "exampleModalLabel" }
                  },
                  [_vm._v("Добавить тип")]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "close",
                    attrs: {
                      type: "button",
                      "data-dismiss": "modal",
                      "aria-label": "Close"
                    }
                  },
                  [
                    _c("span", { attrs: { "aria-hidden": "true" } }, [
                      _vm._v("×")
                    ])
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "modal-body p-0" }, [
                _vm._v("\n                    ...\n                ")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "modal-footer p-0" }, [
                _c(
                  "button",
                  {
                    staticClass: "button p-3 px-4 rounded-pill shadow-sm white",
                    attrs: { "data-dismiss": "modal" }
                  },
                  [
                    _vm._v(
                      "\n                        Отмена\n                    "
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass:
                      "ml-3 button p-3 px-4 rounded-pill shadow-sm tonight green"
                  },
                  [
                    _vm._v(
                      "\n                        Сохранить\n                    "
                    )
                  ]
                )
              ])
            ])
          ]
        )
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/views/app/settings/issues/types.vue":
/*!*******************************************************!*\
  !*** ./resources/views/app/settings/issues/types.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./types.vue?vue&type=template&id=03225f0e&scoped=true& */ "./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true&");
/* harmony import */ var _types_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./types.vue?vue&type=script&lang=js& */ "./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& */ "./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _types_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "03225f0e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/views/app/settings/issues/types.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./types.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&":
/*!****************************************************************************************************************!*\
  !*** ./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& ***!
  \****************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=style&index=0&id=03225f0e&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_style_index_0_id_03225f0e_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./types.vue?vue&type=template&id=03225f0e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/views/app/settings/issues/types.vue?vue&type=template&id=03225f0e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_types_vue_vue_type_template_id_03225f0e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);