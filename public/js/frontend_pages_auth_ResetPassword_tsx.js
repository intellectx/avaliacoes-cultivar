(globalThis["webpackChunkavaliacoes_cultivar"] = globalThis["webpackChunkavaliacoes_cultivar"] || []).push([["frontend_pages_auth_ResetPassword_tsx"],{

/***/ "./frontend/pages/auth/ResetPassword.tsx":
/*!***********************************************!*\
  !*** ./frontend/pages/auth/ResetPassword.tsx ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fortawesome/react-fontawesome */ "./node_modules/@fortawesome/react-fontawesome/index.es.js");
/* harmony import */ var _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @fortawesome/free-solid-svg-icons */ "./node_modules/@fortawesome/free-solid-svg-icons/index.es.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Row.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Col.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Form.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/InputGroup.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Button.js");
/* harmony import */ var _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @inertiajs/inertia-react */ "./node_modules/@inertiajs/inertia-react/dist/index.js");
/* harmony import */ var _config_routes__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../config/routes */ "./frontend/config/routes.ts");
/* harmony import */ var _components_layout_Auth__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/layout/Auth */ "./frontend/components/layout/Auth.tsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");










var ResetPasswordPage = function ResetPasswordPage() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_components_layout_Auth__WEBPACK_IMPORTED_MODULE_4__.default, {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_6__.default, {
      className: "justify-content-center",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default, {
        xs: 12,
        className: "d-flex align-items-center justify-content-center",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
          className: "bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("h3", {
            className: "mb-4",
            children: "Renova\xE7\xE3o de Senha"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default, {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Group, {
              id: "email",
              className: "mb-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Label, {
                children: "Seu E-mail"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default, {
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default.Text, {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__.FontAwesomeIcon, {
                    icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_10__.faEnvelope
                  })
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Control, {
                  autoFocus: true,
                  required: true,
                  type: "email",
                  placeholder: "seu@email.com.br"
                })]
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Group, {
              id: "password",
              className: "mb-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Label, {
                children: "Sua nova senha"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default, {
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default.Text, {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__.FontAwesomeIcon, {
                    icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_10__.faUnlockAlt
                  })
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Control, {
                  required: true,
                  type: "password",
                  placeholder: "Sua nova senha..."
                })]
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Group, {
              id: "confirmPassword",
              className: "mb-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Label, {
                children: "Repita sua senha"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default, {
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_9__.default.Text, {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__.FontAwesomeIcon, {
                    icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_10__.faUnlockAlt
                  })
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Control, {
                  required: true,
                  type: "password",
                  placeholder: "Repita sua senha..."
                })]
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_11__.default, {
              as: _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_2__.InertiaLink,
              replace: true,
              href: _config_routes__WEBPACK_IMPORTED_MODULE_3__.AUTH_ROUTES.LOGIN,
              variant: "primary",
              type: "submit",
              className: "w-100",
              children: "Alterar minha senha"
            })]
          })]
        })
      })
    })
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ResetPasswordPage);

/***/ })

}]);