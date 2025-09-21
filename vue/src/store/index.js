import { createStore } from "vuex";
import axiosClient from "../axios.js";
import axios from "axios";

const Tmpsurvey = [
    {
        id: 1,
        title: "survey 1",
        sulg: "survey-1",
        description: "description survey 1",
        status: "draft",
        image: "https://via.placeholder.com/640x480.png/00ccbb?text=survey+1",
        created_at: "2023-01-01",
        updated_at: "2023-01-01",
        expire_at: "2023-12-31",
        questions: [
            {
                id: 1,
                type: "text",
                question: "what is your name ?",
                description: "description question 1",
                data: {},
            },
            {
                id: 2,
                type: "select",
                question: "form which country are you?",
                description: " descriptiono question 2 ",
                data: {
                    options: [
                        { uuid: "1", text: "egypt" },
                        { uuid: "2", text: "ksa" },
                        { uuid: "3", text: "usa" },
                        { uuid: "4", text: "uk" },
                    ],
                },
            },
            {
                id: 3,
                type: "checkbox",
                question: "which language do you speak?",
                description: " descriptiono question 2 ",
                data: {
                    options: [
                        { uuid: "5", text: "english" },
                        { uuid: "6", text: "arabic" },
                        { uuid: "7", text: "rusian" },
                        { uuid: "8", text: "chaina" },
                    ],
                },
            },
            {
                id: 4,
                type: "radio",
                question: "which program language do you use?",
                description: " descriptiono question 2 ",
                data: {
                    options: [
                        { uuid: "9", text: "php" },
                        { uuid: "10", text: "javascript" },
                        { uuid: "11", text: "python" },
                        { uuid: "12", text: "c++" },
                    ],
                },
            },
        ],
    },
    {
        id: 2,
        title: "survey 2",
        sulg: "survey-2",
        description: "description survey 2",
        status: "draft",
        Image: "https://via.placeholder.com/640x480.png/00ccbb?text=survey+1",
        created_at: "2023-01-01",
        updated_at: "2023-01-01",
        expire_at: "2023-12-31",
        questions: [],
    },
    {
        id: 3,
        title: "survey 3",
        sulg: "survey-3",
        description: "description survey 3",
        status: "draft",
        Image: "https://via.placeholder.com/640x480.png/00ccbb?text=survey+1",
        created_at: "2023-01-01",
        updated_at: "2023-01-01",
        expire_at: "2023-12-31",
        questions: [],
    },
    {
        id: 4,
        title: "survey 4",
        sulg: "survey-4",
        description: "description survey 4",
        status: "draft",
        Image: "https://via.placeholder.com/640x480.png/00ccbb?text=survey+1",
        created_at: "2023-01-01",
        updated_at: "2023-01-01",
        expire_at: "2023-12-31",
        questions: [],
    },
];

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('token'),
        },
        currentsurvey : {
            loading : false , 
            data : {}
        },
        surveys: [],
        typequestion: ["text", "select", "checkbox", "radio", "textarea"],
    },
    getters: {},
    actions: {
        deletesurvey({commit} , id){
            return axiosClient.delete(`/survey/${id}`);
        },
        fetchsurveys({ commit }) {
            return axiosClient.get("/survey").then((res) => {
                // console.log(res.data);
                commit("setSurveys", res.data);
                return res;
            });
        },
        getsurvey ({commit} , id){
            commit('setsurveyloading' , true);
            return axiosClient.get(`/survey/${id}`).then((res) => {
                commit("setsurveyloading" , false);
                console.log(res.data);
                commit("setsurveydata" , res.data);
                return res;
            })
            .catch((err) => {
                // commit('setsurveyloading' , false);
                console.log(err);
                throw err;
            });
        },
        savesurvey({ commit }, survey) {
            let response;
            if (survey.id) {
                response = axiosClient
                    .put(`/survey/${survey.id}`, survey)
                    .then((res) => commit(updatesurvey, res.data));
                    return res;
            } else {
               response = axiosClient.post("/survey", survey).then((res) => {
                  commit("addsurvey" , res.data);
                  return res;
               });
            }

            return response;
        },
        register({ commit }, user) {
            return axiosClient.post('/register' , user)
                .then((data) => {
                    commit("setUser", data);
                    return data;
                });
        },
        login({ commit }, user) {
            return axiosClient.post('/login' , user)
                .then((data) => {
                    commit("setUser", data);
                    return data;
                });
        },
    },
    mutations: {
        setsurveyloading : (state , loading) => {
            state.currentsurvey.loading = loading ; 
        },
        setsurveydata : (state , survey) => {
            state.currentsurvey.data = survey.data ;
        },
        addsurvey : (state , survey) => {
            state.surveys = [ ...state.surveys , survey.data]; 
        },
        setSurveys: (state , surveys) => {
            state.surveys = surveys.data;
        },
        updatesurvey : (state , survey) =>{ 
            state.surveys = state.surveys.map(s => {
                if( s.id === survey.data.id){
                return survey.data;
                }
                return s;
            })
        },
        logout: (state) => {
            (state.user.token = sessionStorage.clear()), (state.user.data = {});
        },
        setUser: (state, userdata) => {
            state.user.token = userdata.data.token;
            state.user.data = userdata.data.user;
            sessionStorage.setItem('token' , userdata.data.token);
            console.log(userdata.data.token);
            console.log(state.user.token);
        },
    },
    modules: {},
});

export default store;
