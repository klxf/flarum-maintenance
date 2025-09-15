import app from 'flarum/admin/app';
import { extend } from "flarum/common/extend";
import { defaultTemplate } from "./defaults";
import AdminTipsWidget from "./components/AdminTipsWidget";
import Button from 'flarum/common/components/Button';
import DashboardPage from "flarum/admin/components/DashboardPage";

app.initializers.add('klxf-maintenance', () => {
    extend(DashboardPage.prototype, "availableWidgets", function (items) {
        const enabled = app.data.settings["klxf-maintenance.enabled"];

        if (enabled === "1") {
            items.add("klxf-maintenance", <AdminTipsWidget />, 100);
        }
    });
    app.extensionData
        .for("klxf-maintenance")
        .registerSetting({
            setting: "klxf-maintenance.enabled",
            type: "boolean",
            label: app.translator.trans(
                "klxf-maintenance.admin.settings.maintenance-mode-enabled.label"
            )
        })
        .registerSetting({
            setting: "klxf-maintenance.title",
            type: "text",
            label: app.translator.trans(
                "klxf-maintenance.admin.settings.maintenance-mode-title.label"
            )
        })
        .registerSetting({
            setting: "klxf-maintenance.message",
            type: "text",
            label: app.translator.trans(
                "klxf-maintenance.admin.settings.maintenance-mode-message.label"
            ),
            className: "FormControl--textarea",
        })
        .registerSetting({
            setting: "klxf-maintenance.template",
            type: "textarea",
            label: app.translator.trans(
                "klxf-maintenance.admin.settings.maintenance-mode-html-template.label"
            ),
            help: app.translator.trans(
                "klxf-maintenance.admin.settings.maintenance-mode-html-template.help"
            ),
            rows: 10
        })
        .registerSetting(function (this: any) {
            return (
                <Button
                    className="Button"
                    onclick={() => {
                        this.settings['klxf-maintenance.template'](defaultTemplate);
                        m.redraw();
                    }}
                >
                    {app.translator.trans('klxf-maintenance.admin.settings.maintenance-mode-html-template.reset-btn')}
                </Button>
            );
        })
        .registerSetting(function () {
            return (
                <div class="helpText" style="margin-top: 10px">
                    <i class="fa-icon fas fa-exclamation-circle"></i> {app.translator.trans('klxf-maintenance.admin.settings.maintenance-mode-html-template.reset-help')}
                </div>
            );
        })
        .registerPermission(
            {
                icon: "fas fa-hard-hat",
                label: app.translator.trans("klxf-maintenance.admin.permissions.bypass"),
                permission: "klxf-maintenance.bypass",
            },
            "view"
        );
});
