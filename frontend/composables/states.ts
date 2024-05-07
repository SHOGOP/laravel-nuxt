import { ref, computed } from "vue";
import { defineStore } from "pinia";

const runtimeConfig = await useRuntimeConfig();
const router = useRouter();

export const useUserCart = defineStore(
    "userCart",
  () => {
      
      const count = ref(0);
      const idList = ref<string[]>([]);
      const qtyList = ref<number[]>([]);
    function addCart(id: string, qty: number) {
      //idが重複している場合はqtyのみ変更
      if (idList.value.includes(id)) {
        const idx = idList.value.indexOf(id)
        qtyList.value[idx]=qtyList.value[idx]+qty
      } else {
        count.value++;
        idList.value.push(id)
        qtyList.value.push(qty)
      }
      }
      function resetCart() {
        count.value = 0
        idList.value = []
        qtyList.value=[]
      }
      function updateCart(id:number,qty:number) {
        qtyList.value[id]=qty
      }
    function removeCart(index:number) {
      count.value--
      idList.value.splice(index, 1);
      qtyList.value.splice(index, 1);
      }
        return { count,idList,qtyList, addCart,resetCart,updateCart,removeCart };
  },
		//persistを追加して状態を保持する
    {
        persist: {
            //ローカルストレージに保存する場合
            storage: persistedState.localStorage,
        },
    }
);
export const useGlobalSetting = defineStore(
    "Global",
    () => {
      const tax = 10;
      function calc_tax(num: number) {
        const per_tax = 1+(tax/100)
        return Math.floor(num * per_tax)
      }
        return { tax ,calc_tax};
  },
		//persistを追加して状態を保持する
    {
        persist: {
            //ローカルストレージに保存する場合
            storage: persistedState.sessionStorage,
        },
    }
);
