import { Inertia } from "@inertiajs/inertia";

export default function useHelper() {
    const unitsConsumed = (prev, curr) => {
        return curr - prev;
    };

    const chargeAmount = (curr, prev, rate) => {
        return (curr - prev) * rate;
    };

    const searchApartment = (apartment) => {
        Inertia.get(
            "/apartments",
            {
                search: apartment,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    };

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
        searchApartment,
        currentDate
    };
}
