<div class="row">
    <p class="multichoiceoption">Select Following Fabrics For ({{subelek}}: {{customizationElement.selection[subelek]}}) </p>
    <table>
        <tr ng-repeat="(itemk, cart) in customFabrics" >
            <td>{{cart.item.title}}</td>
            <td style="width: 70%">
                <span ng-if="!spacialSelection.itemstyle[cart.item.title][subelek]">
                    -----------
                </span>
                <span ng-if="spacialSelection.itemstyle[cart.item.title][subelek]">
                    {{spacialSelection.itemstyle[cart.item.title][subelek]}}
                </span>

            </td>
            <td>
                <button class="btn btn-success" ng-if="spacialSelection.activestyle.skye == subelek" ng-click="changeSpacialSelection(cart.item.title)">Choose</button>
            </td>
        </tr>
    </table>

</div>
