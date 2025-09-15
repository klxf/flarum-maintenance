import app from "flarum/admin/app";
import Alert from "flarum/common/components/Alert";
import DashboardWidget from "flarum/admin/components/DashboardWidget";

export default class AdminTipsWidget extends DashboardWidget {
    className() {
        return "klxlMaintenanceModeWidget";
    }

    content() {
        const title = app.translator.trans("klxf-maintenance.admin.dashboard.maintenance-widget.title");
        const detail = app.translator.trans("klxf-maintenance.admin.dashboard.maintenance-widget.detail");

        return (
            <Alert
                type="error"
                dismissible={false}
                title={title}
                icon="fas fa-hard-hat"
            >
                {detail}
            </Alert>
        );
    }
}