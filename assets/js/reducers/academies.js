const initialStateOfAcademies = {
    academies: [],
    filteredAcademies: [],
};

const academies = (state = initialStateOfAcademies, action) => {
    switch (action.type) {
        case 'setAcademies': return {
            ...state,
            academies: action.academies,
        };
        case 'setFilteredAcademies': return {
            ...state,
            filteredAcademies: action.filteredAcademies,
        };
        default: return state;
    }
};

export default academies;
