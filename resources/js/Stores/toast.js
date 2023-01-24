import { reactive } from "vue";

export default reactive({
    items: [{ message: "Set yourself free" }],

    add(toast){
        this.items.unshift({
            key: Symbol(),
            ...toast
        });
    },
    remove(index){
        this.items.splice(index, 1);
    }
});
