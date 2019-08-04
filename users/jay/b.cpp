#include<bits/stdc++.h>

using namespace std;
typedef long long ll;

#define pb push_back
#define deb(x) cout<<#x<<" : "<<x<<"\n";
#define debug(x,y) cout<<#x<<" : "<<x<<"\t"<<#y<<" : "<<y<<"\n";
#define mset(x,y) memset(x,y,sizeof(x))
#define mp(x,y) make_pair(x,y)
#define ff first
#define ss second
#define mod 1000000007
#define N 100010

ll pow_mod(ll x,ll y)
{
    ll r=1;
    for(;y;y>>=1,x=(ll)x*x%mod)
        if(y&1)r=(ll)r*x%mod;
    return r;
}

ll invertBits(ll num)
{
    if(num == 0)    return 1;
    ll x = log2(num) + 1;

    for (ll i = 0; i < x; i++)
        num = (num ^ (1 << i));

    return num;
}

ll all_1(ll n){
    if(n == 0)  return 1;
    ll x = log2(n) + 1;
    x = pow(2,x) - 1;
    return x;
}

int main(){
    ios_base::sync_with_stdio(false);cin.tie(NULL);cout.tie(NULL);
    int t;
    cin >> t;
    while(t--){
        long n ,k ,s;
        cin >> n >> k >> s;
        ll s_inv = invertBits(s);
        ll n_1 = all_1(n);
        ll ans = 0;
        ans += (n_1*s)%mod;
        ans = (ans + (n*(n+1)/2*s_inv) %mod)%mod;
        ans = (ans*pow_mod(n+1,mod-2))%mod;
        cout << ans << "\n";
    }
    return 0;
}