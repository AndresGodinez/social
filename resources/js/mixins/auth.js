let user = document.head.querySelector('meta[name="user"]');

export default {
    computed:{
        currentUser(){
            if(this.isAuthenticated){
                return JSON.parse(user.content);
            }
            else{
                return {
                    name:'Usuario Invitado'
                }
            }
        },
        isAuthenticated(){
            return !! user.content;
        },

        guest(){
            return  ! this.isAuthenticated()
        }
    }
}
