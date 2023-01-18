import { Inertia } from "@inertiajs/inertia";
import moment from "moment/moment";
export default function useHelper() {
    const unitsConsumed = (prev, curr) => {
        return curr - prev;
    };

    const chargeAmount = (curr, prev, rate) => {
        return (curr - prev) * rate;
    };

    const formatDate = (value)=>{
        return moment(value).format('LL');
    }

    const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const currentDate = ()=>{
        const d = new Date()
         return monthNames[d.getMonth()];
    }

    return {
        unitsConsumed,
        chargeAmount,
        currentDate,
         formatDate
    };
}
