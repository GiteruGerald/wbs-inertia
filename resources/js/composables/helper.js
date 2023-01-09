import { Inertia } from "@inertiajs/inertia";

export default function useHelper() {

    const unitsConsumed = (prev, curr)=>{
        return curr-prev
    }

    const chargeAmount = (curr, prev, rate)=>{
        return (curr-prev)*rate
    }

    const filterByApartment = (apartment)=>{
        Inertia.get('/apartments',{
            search:apartment
        },
        {
            preserveState:true
        })
    }
    
    const searchApartment = (apartment)=>{
        Inertia.get('/apartments',{
            search:apartment
        },
        {
            preserveState:true,
            replace:true
        })
    }


    return{
        unitsConsumed,
        chargeAmount,
        filterByApartment,
        searchApartment
    }
}
