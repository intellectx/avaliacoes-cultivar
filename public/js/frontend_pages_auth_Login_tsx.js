(globalThis["webpackChunkavaliacoes_cultivar"] = globalThis["webpackChunkavaliacoes_cultivar"] || []).push([["frontend_pages_auth_Login_tsx"],{

/***/ "./frontend/pages/auth/Login.tsx":
/*!***************************************!*\
  !*** ./frontend/pages/auth/Login.tsx ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var _fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fortawesome/react-fontawesome */ "./node_modules/@fortawesome/react-fontawesome/index.es.js");
/* harmony import */ var _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @fortawesome/free-solid-svg-icons */ "./node_modules/@fortawesome/free-solid-svg-icons/index.es.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Row.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Col.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Form.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/InputGroup.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/FormCheck.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Card.js");
/* harmony import */ var _themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @themesberg/react-bootstrap */ "./node_modules/@themesberg/react-bootstrap/lib/esm/Button.js");
/* harmony import */ var _config_routes__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../config/routes */ "./frontend/config/routes.ts");
/* harmony import */ var _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @inertiajs/inertia-react */ "./node_modules/@inertiajs/inertia-react/dist/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");









var LoginPage = function LoginPage() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_5__.default, {
    className: "justify-content-center form-bg-image",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_6__.default, {
      xs: 12,
      className: "d-flex align-items-center justify-content-center",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
        className: "bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
          className: "text-center text-md-center mb-4 mt-md-0",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h3", {
            className: "mb-0",
            children: "Avalia\xE7\xF5es Cultivar"
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default, {
          className: "mt-4",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Group, {
            id: "email",
            className: "mb-4",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Label, {
              children: "E-mail"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default, {
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Text, {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__.FontAwesomeIcon, {
                  icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_9__.faEnvelope
                })
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Control, {
                autoFocus: true,
                required: true,
                type: "email",
                placeholder: "seu@email.com.br"
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Group, {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Group, {
              id: "password",
              className: "mb-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Label, {
                children: "Senha"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default, {
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_8__.default.Text, {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_1__.FontAwesomeIcon, {
                    icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_9__.faUnlockAlt
                  })
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Control, {
                  required: true,
                  type: "password",
                  placeholder: "Sua senha de acesso..."
                })]
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
              className: "d-flex justify-content-between align-items-center mb-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_7__.default.Check, {
                type: "checkbox",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_10__.default.Input, {
                  id: "defaultCheck5",
                  className: "me-2"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_10__.default.Label, {
                  htmlFor: "defaultCheck5",
                  className: "mb-0",
                  children: "Lembrar neste PC."
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_11__.default.Link, {
                as: _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_3__.InertiaLink,
                href: _config_routes__WEBPACK_IMPORTED_MODULE_2__.AUTH_ROUTES.FORGOT_PASSWORD,
                className: "small text-end",
                children: "Esqueceu a senha?"
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_themesberg_react_bootstrap__WEBPACK_IMPORTED_MODULE_12__.default, {
            as: _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_3__.InertiaLink,
            replace: true,
            href: _config_routes__WEBPACK_IMPORTED_MODULE_2__.APP_ROUTES.DASHBOARD,
            variant: "primary",
            type: "submit",
            className: "w-100",
            children: "Entrar"
          })]
        })]
      })
    })
  });
}; // @ts-ignore


LoginPage.layout = function (page) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(LoginPage.layout, {
    children: page
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LoginPage);

/***/ })

}]);