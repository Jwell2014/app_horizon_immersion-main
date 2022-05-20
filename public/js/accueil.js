// const btn = document.querySelector('#docImg');
// const text = document.querySelector('.nav2');
// const btn2 = document.querySelector('#info');
// const text2 = document.querySelector('.nav3');
//
// let visible = false;
// let active = false;
//
// btn.addEventListener('click', () => {
//    visible = !visible;
//     visible ? text.classList.add('visible') : text.classList.remove('visible'), text2.classList.remove('visible'), btn2.classList.remove('active');
//
//
// });
//
// btn2.addEventListener('click', () => {
//     active = !active;
//     text2.classList.toggle('visible');
//     btn2.classList.toggle('active');
// });
//
//
//
// document.querySelector('#dossierImage').addEventListener('hidden.bs.modal', () => {
//     text2.classList.remove('visible');
//     btn2.classList.remove('active');
// });

const openNavCateg = document.querySelector('.iconeDoc');
const dossier = document.querySelector('.sub-nav');
const openDocs = document.querySelectorAll('.openDocument');
const docs = document.querySelectorAll('.sub-doc');

let openDossier= false;


openNavCateg.addEventListener('click', (e) => {
    console.log(e);
    openDossier = !openDossier;
    openDossier ? dossier.classList.add('openDossier') : dossier.classList.remove('openDossier') ;
});


for(let i = 0; i < openDocs.length; i++){
    console.log(i);
    openDocs[i].addEventListener('click', (e) => {
        console.log(e.target.id)
        for(let e = 0; e < docs.length; e++){
            openDossier = !openDossier;
            openDossier ? docs[e].classList.add('openDoc') : docs[e].classList.remove('openDoc');

            console.log(docs[e])

        };

});
}



// openDocs.addEventListener('click', () => {
//         console.log('ok')
//         openDossier = !openDossier;
//         openDossier ? doc.classList.add('openDoc') : doc.classList.remove('openDoc');
//
// });






// script pour le bouton apli tableau et ratp



/*
// Permet de supprimer toute les fenetre ouverte lors de la fermeture de la modal
document.querySelector('.ferm').addEventListener('click', () => {
    visible = !visible;
    visible ? text.classList.add('visible') : text.classList.remove('visible'), text2.classList.remove('visible');
    btn2.classList.remove('active');
});

// Permet de supprimer toute les fenetre ouverte lors de la fermeture de la modal
document.querySelector('.btn-secondary').addEventListener('click', () => {
    visible = !visible;
    visible ? text.classList.add('visible') : text.classList.remove('visible'), text2.classList.remove('visible');
    btn2.classList.remove('active');

});*/



// script pour le chrono - horloge


let hour = 11;
let minute = 59;
let second = 55;
let millisecond = 0;

let h = 11;
let m = 59;
let s = 55;

let cron;

document.form_main.start.onclick = () => start();
document.form_main.pause.onclick = () => pause();
document.form_main.reset.onclick = () => reset();

function start() {
    pause();
    cron = setInterval(() => {
        timer();
    }, 10);
}

function pause() {
    clearInterval(cron);
}

function reset() {
    hour = 11;
    minute = 59;
    second = 55;
    millisecond = 0;

    h = 11;
    m = 59;
    s = 55;

    document.getElementById('hour').innerText = '11';
    document.getElementById('minute').innerText = '59';
    document.getElementById('second').innerText = '55';

    document.getElementById('h').innerText = '11';
    document.getElementById('m').innerText = '59';
    document.getElementById('s').innerText = '55';


}

function timer() {


    if ((millisecond += 10) === 1000) {
        millisecond = 0;
        second++;
        s++;
    }
    if (second === 60 && s === 60) {
        second = 0;
        s = 0;

        m++;
        minute++;

    }
    if (minute === 60 && m === 60) {
        minute = 0;
        m = 0;

        h++;
        hour++;

    }




    document.getElementById('hour').innerText = returnData(hour);
    document.getElementById('minute').innerText = returnData(minute);
    document.getElementById('second').innerText = returnData(second);

    document.getElementById('h').innerText = returnData(h);
    document.getElementById('m').innerText = returnData(m);
    document.getElementById('s').innerText = returnData(s);


}

function returnData(input) {
    return input >= 10 ? input : `0${input}`
}


// // Partir metro
//
//
// import axios from "axios";
//
// let riddlesCount, riddles = [];
// axios.get("/api/riddles").then((e => {
//     riddlesCount = e.data["hydra:member"].length, $.each(e.data["hydra:member"], (function (e, s) {
//         riddles[e] = {question: s.question.split("-"), answer: s.answer, trainSpeed: 70 - 60 / riddlesCount * e}
//     })), riddles.push({trainSpeed: 10})
// }));
// let session_id = $(".userInfo").data("session"), ratp_session = [];
// !async function e() {
//     axios.get("/api/ratp_sessions/" + session_id).then((e => {
//         ratp_session = {
//             current_step: e.data.currentStep,
//             session_id: e.data.id,
//             session_name: e.data.identifier,
//             started: e.data.started,
//             current_percent: e.data.currentPercent
//         }, ratp_session.user_players = $.each(e.data.userPlayers, (function (e) {
//         })), ratp_session.current_step ? ratp_session.current_step_c = e.data.currentStep.split("-") : ratp_session.current_step_c = "none", null == ratp_session.started ? ($(".appContent, .appLoading").addClass("d-none").removeClass("d-block"), $(".appAlerts, .appWaitStart").addClass("d-block").removeClass("d-none")) : "win" === ratp_session.current_step ? ($(".appContent, .appLoading, .appFailureScreen, .appWaitStart").addClass("d-none").removeClass("d-block"), $(".appAlerts, .appSuccessScreen").addClass("d-block").removeClass("d-none")) : +ratp_session.current_percent >= 99 ? ($(".appContent, .appLoading, .appWaitStart, .appSuccessScreen").addClass("d-none").removeClass("d-block"), $(".appAlerts, .appFailureScreen").addClass("d-block").removeClass("d-none")) : ($(".appAlerts, .appLoading, .appWaitStart, .appFailureScreen, .appSuccessScreen").addClass("d-none").removeClass("d-block"), $(".appContent").addClass("d-block").removeClass("d-none"), $(".speedNumber").text(riddles["none" === ratp_session.current_step_c ? 0 : ratp_session.current_step_c.length].trainSpeed + " km/h"), ratp_session.current_step_c.length === riddlesCount ? ($("#riddleInput, #riddleSubmit").addClass("d-none"), $("#currentStep").addClass("d-none").removeClass("d-flex"), $("#trainSwitch").addClass("d-flex").removeClass("d-none")) : ($(riddles).each((function (e, s) {
//             if (e < riddlesCount) if ("none" === ratp_session.current_step_c) {
//                 if (!$("#numberSeries" + e).hasClass("stillNotFound")) {
//                     $(s.question).each((function (t) {
//                         $("#numberSeries" + e).addClass("numberSeriesList stillNotFound").removeClass("numberFound").append("<div>" + s.question[t] + "</div>")
//                     }));
//                     const t = document.querySelector("#numberSeries" + e), n = new SlotMachine(t, {});
//                     setInterval((function () {
//                         n.prev()
//                     }), 950)
//                 }
//             } else $(ratp_session.current_step_c).each((function (t) {
//                 if (ratp_session.current_step_c[t] === riddles[e].answer) return $("#numberSeries" + e).text(s.answer).addClass("numberFound").removeClass("numberSeriesList stillNotFound"), !1;
//                 if (!$("#numberSeries" + e).hasClass("stillNotFound")) {
//                     $(s.question).each((function (t) {
//                         $("#numberSeries" + e).addClass("numberSeriesList stillNotFound").removeClass("numberFound").append("<div>" + s.question[t] + "</div>")
//                     }));
//                     const t = document.querySelector("#numberSeries" + e), n = new SlotMachine(t, {});
//                     setInterval((function () {
//                         n.prev()
//                     }), 950)
//                 }
//             }))
//         })), $("#riddleInput, #riddleSubmit").removeClass("d-none"), $("#currentStep").addClass("d-flex").removeClass("d-none"), $("#trainSwitch").addClass("d-none").removeClass("d-flex")))
//     })), setTimeout(e, 1e3)
// }(), $((function () {
//     $("#riddleInput").bind("input", (function () {
//         this.setAttribute("value", this.value)
//     }))
// })), $("#riddleSubmit").click((function () {
//     let e = $("#riddleInput"), s = $("#riddleInputResult"), t = [];
//     $(riddles).each((function (e) {
//         e < riddlesCount && ("none" === ratp_session.current_step_c ? t.push(riddles[e].answer) : $(ratp_session.current_step_c).each((function (s) {
//             if (ratp_session.current_step_c[s] === riddles[e].answer) return !1;
//             s === ratp_session.current_step_c.length - 1 && t.push(riddles[e].answer)
//         })))
//     })), $(t).each((function (n) {
//         if (e.attr("value") === t[n]) return axios.put("/api/ratp_sessions/" + session_id, {currentStep: "none" === ratp_session.current_step_c ? e.attr("value") : ratp_session.current_step + "-" + e.attr("value")}), s.text("CODE VALIDE, VITESSE DIMINUÉE").removeClass("invisible text-danger").addClass("text-success"), setTimeout((() => {
//             s.addClass("invisible").removeClass("text-success")
//         }), 1200), !1;
//         s.text("ERREUR").removeClass("invisible text-success").addClass("text-danger"), setTimeout((() => {
//             s.addClass("invisible").removeClass("text-danger")
//         }), 1200)
//     })), $(e).val("").attr("value", "")
// })), $("#trainSwitch").click((function () {
//     axios.put("/api/ratp_sessions/" + session_id, {currentStep: "win"})
// }));
// let loopTime = 1e3, run = setInterval(loopBars, loopTime);
//
// function loopBars() {
//     if (clearInterval(run), void 0 === ratp_session.current_step_c) loopTime = 2500; else if (loopTime = 16500 / (riddles["none" === ratp_session.current_step_c ? 0 : ratp_session.current_step_c.length].trainSpeed / 3.6) / .2, null !== ratp_session.started) {
//         let e = $(".progressPastDist"),
//             s = +$(".progress").css("width").replace("px", "") / 100 * +ratp_session.current_percent;
//         if (99 != +ratp_session.current_percent) {
//             let t = s + .5 + "px";
//             e.css({width: t}), axios.put("/api/ratp_sessions/" + session_id, {currentPercent: (+ratp_session.current_percent + .5).toString()})
//         }
//     }
//     run = setInterval(loopBars, loopTime)
// }
//
// setInterval((function () {
//     if (null !== ratp_session.started) {
//         let e = $(".progressTrain").collision($(".stationIcon i"));
//         if (e.length) {
//             let s = $(e[0].parentElement).attr("data-number"), t = $(".stationIcon[data-number=" + s + "] i");
//             $(".stationIcon i").css({color: "#f9cc01"}), t.css({color: "#cd2020"})
//         } else $(".stationIcon i").css({color: "#f9cc01"})
//     }
// }), 250);