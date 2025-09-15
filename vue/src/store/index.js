
import {createStore} from 'vuex'

const Tmpsurvey = [
   {
      id : 1,
      title : 'survey 1',
      sulg: 'survey-1',
      description : 'description survey 1',
      status : 'draft',
      image: 'https://via.placeholder.com/640x480.png/00ccbb?text=survey+1',
      created_at : '2023-01-01',
      updated_at : '2023-01-01',
      expire_at : '2023-12-31',
      questions : [
         {
            id : 1,
            type : 'text',
            question : 'what is your name ?',
            description : 'description question 1',
            data : {},
         },
         {
            id : 2,
            type : 'select',
            question : 'form which country are you?',
            description : ' descriptiono question 2 ',
            data: {
               options : [
                  { uuid : '1' , text : 'egypt' },
                  { uuid : '2' , text : 'ksa' },
                  { uuid : '3' , text : 'usa' },
                  { uuid : '4' , text : 'uk' },
               ],
            }
         },
         {
            id : 3,
            type : 'checkbox',
            question : 'which language do you speak?',
            description : ' descriptiono question 2 ',
            data: {
               options : [
                  { uuid : '5' , text : 'english' },
                  { uuid : '6' , text : 'arabic' },
                  { uuid : '7' , text : 'rusian' },
                  { uuid : '8' , text : 'chaina' },
               ],
            }
         },
         {
            id : 4,
            type : 'radio',
            question : 'which program language do you use?',
            description : ' descriptiono question 2 ',
            data: {
               options : [
                  { uuid : '9' , text : 'php' },
                  { uuid : '10' , text : 'javascript' },
                  { uuid : '11' , text : 'python' },
                  { uuid : '12' , text : 'c++' },
               ],
            }
         }
      ]
      
   },
   {
      id : 2,
      title : 'survey 2',
      sulg: 'survey-2',
      description : 'description survey 2',
      status : 'draft',
      Image: 'https://via.placeholder.com/640x480.png/00ccbb?text=survey+1',
      created_at : '2023-01-01',
      updated_at : '2023-01-01',
      expire_at : '2023-12-31',
      questions : []
   },
   {
      id : 3,
      title : 'survey 3',
      sulg: 'survey-3',
      description : 'description survey 3',
      status : 'draft',
      Image: 'https://via.placeholder.com/640x480.png/00ccbb?text=survey+1',
      created_at : '2023-01-01',
      updated_at : '2023-01-01',
      expire_at : '2023-12-31',
      questions : []

   },
   {
      id : 4,
      title : 'survey 4',
      sulg: 'survey-4',
      description : 'description survey 4',
      status : 'draft',
      Image: 'https://via.placeholder.com/640x480.png/00ccbb?text=survey+1',
      created_at : '2023-01-01',
      updated_at : '2023-01-01',
      expire_at : '2023-12-31',
      questions : []

   }
]

 const store = createStore({
   state: {
      user: {
         data: { name : 'mohammed' , id : 1 },
         token: '1'
      },
      surveys : [...Tmpsurvey],
      typequestion : ['text' , 'select' , 'checkbox' , 'radio' , 'textarea' ]
   },
   getters: {},
   actions: {},
   mutations: {
      logout : state=>{
         state.user.token = null , 
         state.user.data = {}
      }
   },
   modules: {},
 })

 export default store ;