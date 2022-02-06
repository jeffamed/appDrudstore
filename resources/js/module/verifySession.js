import moment from "moment";

function verifySession() {
    let expire = localStorage.getItem('time_session');
    let now = moment().format('Y-MM-DD');

    if (!expire || now === expire){
        localStorage.removeItem('user');
        localStorage.removeItem('permissions');
        localStorage.removeItem('time_session')
    }
}

export default verifySession;
