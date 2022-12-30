export default function useHelper() {

    const unitsConsumed = (prev, curr)=>{
        return curr-prev
    }

    const chargeAmount = (curr, prev, rate)=>{
        return (curr-prev)*rate
    }

    return{
        unitsConsumed,
        chargeAmount
    }
}
