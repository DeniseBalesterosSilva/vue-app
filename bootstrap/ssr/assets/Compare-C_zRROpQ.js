import "@inertiajs/vue3";
import { S as Section, A as AppLayout } from "./Section-x51FvwYX.js";
import { resolveComponent, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-1tPrXgE0.js";
const _sfc_main = {
  layout: AppLayout,
  name: "Compare",
  components: {
    Section
  },
  props: {}
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Section = resolveComponent("Section");
  _push(ssrRenderComponent(_component_Section, _attrs, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<h3${_scopeId}>Compare</h3>`);
      } else {
        return [
          createVNode("h3", null, "Compare")
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Compare.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Compare = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Compare as default
};
