import Auth from './Auth'
import Settings from './Settings'
import DashboardController from './DashboardController'
import Admin from './Admin'
import PatientController from './PatientController'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    Settings: Object.assign(Settings, Settings),
    DashboardController: Object.assign(DashboardController, DashboardController),
    Admin: Object.assign(Admin, Admin),
    PatientController: Object.assign(PatientController, PatientController),
}

export default Controllers