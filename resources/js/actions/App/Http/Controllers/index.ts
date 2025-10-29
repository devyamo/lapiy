import Auth from './Auth'
import Settings from './Settings'
import PatientController from './PatientController'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    Settings: Object.assign(Settings, Settings),
    PatientController: Object.assign(PatientController, PatientController),
}

export default Controllers