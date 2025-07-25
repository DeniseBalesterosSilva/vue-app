export default {
  methods: {
    moneyFormat(value) {
       if (!value) return 'R$ 0,00';
       if(isNaN(value)){
        return value;
       }
       return 'R$ ' + value.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    },
    percentformat(number)
    {
      return number;
        return (number * 100).toFixed(2).replace('.', ',')
    }
  }
}