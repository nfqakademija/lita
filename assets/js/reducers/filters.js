const initialStateOfFilters = {
    cityOptions: [],
    typeOptions: [],
    selectedCity: null,
    selectedType: null,
    selectedPrice: 'Pigiausios viršuje',
};

const filters = (state = initialStateOfFilters, action) => {
    switch (action.type) {
        case 'setCityOptions': return {
            ...state,
            cityOptions: action.cityOptions,
        };
        case 'setTypeOptions': return {
            ...state,
            typeOptions: action.typeOptions,
        };
        case 'setSelectedCity': return {
            ...state,
            selectedCity: action.selectedCity,
        };
        case 'setSelectedType': return {
            ...state,
            selectedType: action.selectedType,
        };
        case 'setPrice': return {
            ...state,
            selectedPrice: action.selectedPrice,
        };
        default: return state;
    }
};

export default filters;
